<?php

namespace App\Publishing;

use Djfabrizia\Content\Enums\PublishEventStatus;
use Djfabrizia\Content\Models\PublishEvent;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Sends pending topics to the endpoint's cache warm and records the outcome.
 *
 * Topics that could not be sent (endpoint busy, rate limited, down) go back to
 * the pending set; the every-minute `endpoint:warm` task retries them.
 */
class EndpointWarmer
{
    private const TIMEOUT_SECONDS = 20;

    public function __construct(private readonly PendingWarmTopics $pending) {}

    /**
     * @param  list<string>  $topics  extra topics to send now (e.g. ["all"])
     */
    public function flush(array $topics = []): ?PublishEvent
    {
        $this->pending->add($topics);
        $topics = $this->pending->pull();

        if ($topics === []) {
            return null;
        }

        $url = rtrim((string) config('cms.endpoint.url'), '/').'/api/v1/cache/warm';
        $token = (string) config('cms.endpoint.warm_token');

        if ($token === '') {
            $this->pending->add($topics);

            return $this->record($topics, PublishEventStatus::Failed, ['error' => 'ENDPOINT_WARM_TOKEN is not set.']);
        }

        try {
            $response = Http::acceptJson()
                ->timeout(self::TIMEOUT_SECONDS)
                ->withHeaders(['X-Warm-Token' => $token])
                ->post($url, ['topics' => $topics]);
        } catch (ConnectionException $exception) {
            $this->pending->add($topics);
            Log::warning('Endpoint cache warm failed', ['error' => $exception->getMessage()]);

            return $this->record($topics, PublishEventStatus::Failed, ['error' => 'Endpoint unreachable: '.$exception->getMessage()]);
        }

        if ($response->successful()) {
            return $this->record($topics, PublishEventStatus::Warmed, [
                'http_status' => $response->status(),
                'totals' => $response->json('totals'),
                'duration_ms' => $response->json('duration_ms'),
            ]);
        }

        $this->pending->add($topics);
        $busy = in_array($response->status(), [409, 429], true);

        return $this->record($topics, $busy ? PublishEventStatus::Queued : PublishEventStatus::Failed, [
            'http_status' => $response->status(),
            'error' => $busy ? 'Endpoint busy; retried within a minute.' : mb_substr($response->body(), 0, 500),
        ]);
    }

    /**
     * @param  list<string>  $topics
     * @param  array<string, mixed>  $response
     */
    private function record(array $topics, PublishEventStatus $status, array $response): PublishEvent
    {
        return PublishEvent::query()->create([
            'user_id' => Auth::id(),
            'targets' => $topics,
            'status' => $status,
            'response' => $response,
        ]);
    }
}
