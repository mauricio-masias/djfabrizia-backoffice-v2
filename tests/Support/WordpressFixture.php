<?php

namespace Tests\Support;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * A tiny WordPress database (the tables and columns the importer reads) on an
 * in-memory SQLite connection named "wordpress", with the dj_ prefix.
 */
final class WordpressFixture
{
    private int $metaId = 0;

    public static function create(): self
    {
        config(['database.connections.wordpress' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => 'dj_',
            'foreign_key_constraints' => false,
        ]]);
        DB::purge('wordpress');

        $schema = Schema::connection('wordpress');

        $schema->create('posts', function (Blueprint $table): void {
            $table->unsignedBigInteger('ID')->primary();
            $table->string('post_title')->default('');
            $table->string('post_status')->default('publish');
            $table->string('post_type');
            $table->string('post_date')->default('2024-01-01 10:00:00');
            $table->text('post_content')->default('');
            $table->string('post_mime_type')->default('');
            $table->integer('menu_order')->default(0);
        });
        $schema->create('postmeta', function (Blueprint $table): void {
            $table->unsignedBigInteger('meta_id')->primary();
            $table->unsignedBigInteger('post_id');
            $table->string('meta_key');
            $table->text('meta_value')->nullable();
        });
        $schema->create('term_relationships', function (Blueprint $table): void {
            $table->unsignedBigInteger('object_id');
            $table->unsignedBigInteger('term_taxonomy_id');
        });
        $schema->create('db7_forms', function (Blueprint $table): void {
            $table->unsignedBigInteger('form_id')->primary();
            $table->unsignedBigInteger('form_post_id');
            $table->text('form_value');
            $table->string('form_date');
        });

        return new self;
    }

    /**
     * @param  array<string, string|int|null>  $meta
     * @param  array<string, mixed>  $columns
     */
    public function post(int $id, string $type, string $title, array $meta = [], array $columns = []): self
    {
        DB::connection('wordpress')->table('posts')->insert([
            'ID' => $id,
            'post_type' => $type,
            'post_title' => $title,
            ...$columns,
        ]);

        return $this->meta($id, $meta);
    }

    /**
     * @param  array<string, string|int|null>  $meta
     */
    public function meta(int $postId, array $meta): self
    {
        foreach ($meta as $key => $value) {
            DB::connection('wordpress')->table('postmeta')->insert([
                'meta_id' => ++$this->metaId,
                'post_id' => $postId,
                'meta_key' => $key,
                'meta_value' => $value === null ? null : (string) $value,
            ]);
            // ACF stores a "_{field}" reference row next to every value.
            DB::connection('wordpress')->table('postmeta')->insert([
                'meta_id' => ++$this->metaId,
                'post_id' => $postId,
                'meta_key' => '_'.$key,
                'meta_value' => 'field_'.md5($key),
            ]);
        }

        return $this;
    }

    public function menuItem(int $id, int $menuTermId, string $title, string $url, int $order, int $parent = 0, string $target = ''): self
    {
        DB::connection('wordpress')->table('term_relationships')->insert(['object_id' => $id, 'term_taxonomy_id' => $menuTermId]);

        return $this->post($id, 'nav_menu_item', $title, [
            '_menu_item_url' => $url,
            '_menu_item_menu_item_parent' => $parent,
            '_menu_item_target' => $target,
        ], ['menu_order' => $order]);
    }

    /**
     * @param  array<string, string>  $values
     */
    public function formSubmission(int $id, int $formPostId, array $values, string $date = '2025-01-02 03:04:05'): self
    {
        DB::connection('wordpress')->table('db7_forms')->insert([
            'form_id' => $id,
            'form_post_id' => $formPostId,
            'form_value' => serialize($values),
            'form_date' => $date,
        ]);

        return $this;
    }

    /**
     * A small but complete WordPress site: every post type, page and repeater
     * the importer reads, plus rows it must skip.
     */
    public function sampleSite(): self
    {
        $wp = $this;

        $wp->post(501, 'attachment', 'cyberdog', ['_wp_attached_file' => '2024/03/cyberdog.jpg', '_wp_attachment_image_alt' => 'At Cyberdog'], ['post_status' => 'inherit', 'post_mime_type' => 'image/jpeg'])
            ->post(502, 'attachment', 'headshot', ['_wp_attached_file' => '2024/03/headshot.jpg'], ['post_status' => 'inherit', 'post_mime_type' => 'image/jpeg'])
            ->post(503, 'attachment', 'sand', ['_wp_attached_file' => 'tracks/sand.mp3'], ['post_status' => 'inherit', 'post_mime_type' => 'audio/mpeg']);

        $wp->post(101, 'mixes', 'House Live - Colony Club', [
            'mix_url' => '/djfabrizia/colony-club/', 'mix_img' => 'https://img/320.jpg', 'mix_small_img' => 'https://img/50.jpg',
            'mix_date' => '2014-04-19T18:58:55Z', 'mix_audio_length' => '63:6',
            'mix_tags' => '["Tech house","TechHouse","House"]', 'mix_short_name' => 'Colony Club',
        ], ['post_date' => '2014-04-20 10:00:00']);

        $wp->post(201, 'releases', 'Sand (Original Mix)', [
            'release_cover_art' => 'remote', 'release_cover_art_external' => 'https://cover/sand.jpg',
            'release_track' => 503, 'release_time' => '7:00', 'release_bpm' => '124bpm',
            'release_description' => ' Tech House | KluBasic plus | 2020',
            'release_spotify_label' => 'Spotify', 'release_spotify_link' => 'https://open.spotify.com/track/1',
            'release_itunes_label' => 'iTunes', 'release_itunes_link' => '',
            'release_traxsource_label' => 'Traxsource', 'release_traxsource_link' => 'https://traxsource.com/1',
        ]);

        $wp->post(301, 'videos', 'Live', ['video_id' => 'L_2sQhuj8bI', 'video_title' => 'Live at Hakkasan', 'video_time' => '2:04:13'])
            ->post(302, 'videos', 'Live again', ['video_id' => 'L_2sQhuj8bI', 'video_title' => 'Duplicate']);

        $wp->post(401, 'international', 'Italy', [
            'default_country' => '1',
            'country_city' => 2,
            'country_city_0_city_name' => 'Milan', 'country_city_0_club_name' => 2,
            'country_city_0_club_name_0_item_name' => 'Plastic', 'country_city_0_club_name_1_item_name' => 'Magazzini',
            'country_city_1_city_name' => 'Rome', 'country_city_1_club_name' => 0,
        ]);

        $wp->menuItem(14, 2, 'About', '#', 1)
            ->menuItem(1008, 2, 'Bio', 'http://bio', 2, parent: 14)
            ->menuItem(1009, 2, 'icon-instagram', 'https://www.instagram.com/djfabrizia/', 3, target: '_blank');

        $wp->post(952, 'page', 'API - Homepage', [
            'hero_rotator' => 2, 'hero_rotator_0_item' => 'House', 'hero_rotator_1_item' => 'Techno',
            'about_me_title' => 'About me', 'about_me_left' => 'Left', 'about_me_right' => 'Right',
            'mixes_title' => 'Mixes', 'mixes_paginate' => 9, 'mixes_more_button' => 'More mixes',
            'releases_title' => 'Releases', 'releases_paginate' => 6, 'releases_more_button' => 'More',
            'playlists_title' => 'Playlists', 'playlists_paginate' => 6, 'playlists_more_button' => 'More',
            'book_me_title' => 'Book me', 'book_me_left' => 'L', 'book_me_right' => 'R', 'book_me_success' => 'Thanks',
            'book_me_pa' => 'Big PA', 'book_me_lights' => 'Lights', 'book_me_booth' => 'Booth', 'book_me_controller' => 'CDJ',
        ]);
        $wp->post(7, 'page', 'API - Bio', [
            'bio_title' => 'Bio', 'bio_left' => 'L', 'bio_right' => 'R', 'uk_gigs_title' => 'UK gigs', 'international_title' => 'International',
            'uk_venues' => 3, 'uk_venues_0_uk_venue' => 'Hakkasan', 'uk_venues_1_uk_venue' => 'Fabric', 'uk_venues_2_uk_venue' => 'Ministry',
        ]);
        $wp->post(967, 'page', 'API - Social', [
            'social_title' => 'Social', 'social_icons' => 2,
            'social_icons_0_icon_network' => 'Instagram', 'social_icons_0_icon_class' => 'fa-instagram', 'social_icons_0_icon_type' => 'brands',
            'social_icons_0_icon_link' => 'https://www.instagram.com/djfabrizia', 'social_icons_0_icon_app_link' => 'instagram://user?username=djfabrizia',
            'social_icons_1_icon_network' => 'Spotify', 'social_icons_1_icon_class' => 'fa-spotify', 'social_icons_1_icon_type' => 'brands',
            'social_icons_1_icon_link' => 'https://open.spotify.com/user/11162006882',
        ]);
        $wp->post(39, 'page', 'API - Videos', ['video_title' => 'Videos', 'video_channel_id' => 'UC123']);
        $wp->post(1347, 'page', 'API - Linktree', [
            'linkt_top_image' => 502, 'linkt_top_title' => 'DJ Fabrizia', 'linkt_top_teaser' => 'Teaser',
            'linkt_page_background' => '#000000', 'linkt_font_color' => '#FFFFFF', 'linkt_font_position' => serialize(['center']),
            'linkt_sections' => 2,
            'linkt_sections_0_section_label' => 'RECENT GIGS', 'linkt_sections_0_section_id' => 5,
            'linkt_sections_1_section_label' => 'WELCOME', 'linkt_sections_1_section_id' => 1,
            'linkt_linktree' => 2,
            'linkt_linktree_0_link_media' => 'custom', 'linkt_linktree_0_link_description' => '21.04 | Cyberdog',
            'linkt_linktree_0_link_image' => 501, 'linkt_linktree_0_link_url' => 'http://cyberdog.net',
            'linkt_linktree_0_link_section' => serialize(['5']),
            'linkt_linktree_1_link_media' => 'spotify-custom', 'linkt_linktree_1_link_description' => 'Spotify',
            'linkt_linktree_1_link_url' => 'another', 'linkt_linktree_1_link_section' => serialize(['5', '1']),
        ]);
        $wp->post(3, 'page', 'Privacy Policy', [], ['post_content' => '<p>Privacy</p>']);

        $epk = [
            'intro_email_label' => 'Email', 'about_reel_title' => 'Reel', 'about_reel_image' => 502,
            'about_tailored_title' => 'Tailored sets', 'about_tailored_text' => 'Tailored text', 'about_renowed_text' => 'Renowned',
            'whatOffers_title' => 'What I offer', 'whatOffers_offer4' => 'Producer', 'whatOffers_offer4_text' => 'Producer text',
            'mixes_title' => 'Mixes', 'mixes' => 1, 'mixes_0_label' => 'Latest', 'mixes_0_mix' => 101,
        ];

        foreach ([1452, 1565, 1606, 1608, 1707, 1709] as $id) {
            $wp->post($id, 'page', "EPK {$id}", $epk);
        }

        $wp->formSubmission(1, 986, ['cfdb7_status' => 'read', 'your-name' => 'Michael', 'your-email' => 'michael@example.com', 'your-message' => 'Hi'])
            ->formSubmission(2, 894, ['your-name' => 'T-shirt', 'your-email' => 'tshirt@example.com'])
            ->formSubmission(3, 986, ['your-name' => 'No email']);

        // A serialized object must never be instantiated.
        DB::connection('wordpress')->table('db7_forms')->insert([
            'form_id' => 4, 'form_post_id' => 986, 'form_value' => 'O:8:"stdClass":1:{s:4:"evil";s:1:"x";}', 'form_date' => '2025-01-01 00:00:00',
        ]);

        return $this;
    }
}
