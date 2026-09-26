# Dockerfile (local development only; production is shared hosting)
# Same base image and extensions as djfabrizia-endpoint/docker/Dockerfile,
# plus gd for Filament image uploads and webp variants, and node/npm for
# Vite and the Filament theme build.
FROM dunglas/frankenphp:php8.4-alpine

# System deps
RUN apk add --no-cache \
    linux-headers \
    icu-dev \
    libzip-dev \
    zlib-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    nodejs \
    npm

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    sockets \
    pcntl \
    exif \
    bcmath \
    intl \
    zip \
    gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set PHP memory limit to 1024M
RUN echo "memory_limit = 1024M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Allow Filament image uploads larger than the 2M default
RUN printf "upload_max_filesize = 64M\npost_max_size = 64M\n" > /usr/local/etc/php/conf.d/uploads.ini
