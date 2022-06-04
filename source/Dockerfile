FROM laravelphp/vapor:php80

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/

COPY . .

RUN composer install

# RUN composer dump-autoload
# RUN php artisan optimize

CMD [ "php","artisan","serve","--host=0.0.0.0","--port=9000" ]

# Expose port 9000 and start php-fpm server
EXPOSE 9000
# CMD ["php-fpm"]