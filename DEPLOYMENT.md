# Deployment Guide

This guide covers deploying CustomCraft to various hosting platforms.

## 🚀 Production Checklist

Before deploying, ensure you have:

-   [ ] Set `APP_ENV=production`
-   [ ] Set `APP_DEBUG=false`
-   [ ] Generated secure `APP_KEY`
-   [ ] Configured database credentials
-   [ ] Set up email configuration
-   [ ] Configured file storage
-   [ ] Set up SSL certificate
-   [ ] Configured backup strategy

## 🌐 Shared Hosting (cPanel)

### 1. Prepare Files

```bash
# Build production assets
npm run build

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Upload Files

-   Upload all files except `public` folder contents to root directory
-   Upload `public` folder contents to `public_html`
-   Update `public_html/index.php` paths:

```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

### 3. Environment Configuration

Create `.env` file in root directory:

```env
APP_NAME=CustomCraft
APP_ENV=production
APP_KEY=your-generated-key
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=mail.yourdomain.com
MAIL_PORT=587
MAIL_USERNAME=noreply@yourdomain.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

### 4. Database Setup

```bash
# Run migrations
php artisan migrate --force

# Seed database (optional)
php artisan db:seed --force
```

### 5. File Permissions

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## 🐳 Docker Deployment

### 1. Create Dockerfile

```dockerfile
FROM php:8.1-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    supervisor \
    nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN addgroup -g 1000 www
RUN adduser -u 1000 -G www -s /bin/sh -D www

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
```

### 2. Docker Compose

```yaml
version: "3.8"

services:
    app:
        build:
            context: .
            dockerfile: Dockerfile
        container_name: customcraft-app
        restart: unless-stopped
        working_dir: /var/www
        volumes:
            - ./:/var/www
            - ./docker/php/local.ini:/usr/local/etc/php/conf.d/local.ini
        networks:
            - customcraft

    db:
        image: mysql:8.0
        container_name: customcraft-db
        restart: unless-stopped
        environment:
            MYSQL_DATABASE: customcraft
            MYSQL_ROOT_PASSWORD: password
            MYSQL_USER: customcraft
            MYSQL_PASSWORD: password
        volumes:
            - dbdata:/var/lib/mysql
        networks:
            - customcraft

    nginx:
        image: nginx:alpine
        container_name: customcraft-nginx
        restart: unless-stopped
        ports:
            - "80:80"
            - "443:443"
        volumes:
            - ./:/var/www
            - ./docker/nginx/:/etc/nginx/conf.d/
        networks:
            - customcraft

networks:
    customcraft:
        driver: bridge

volumes:
    dbdata:
        driver: local
```

## ☁️ AWS EC2 Deployment

### 1. Launch EC2 Instance

-   Choose Ubuntu 22.04 LTS
-   Configure security groups (HTTP, HTTPS, SSH)
-   Create or use existing key pair

### 2. Install Dependencies

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP and extensions
sudo apt install php8.1 php8.1-fpm php8.1-mysql php8.1-gd php8.1-mbstring php8.1-xml php8.1-curl php8.1-zip -y

# Install Nginx
sudo apt install nginx -y

# Install MySQL
sudo apt install mysql-server -y

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install nodejs -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 3. Configure Nginx

Create `/etc/nginx/sites-available/customcraft`:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/customcraft/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 4. Deploy Application

```bash
# Clone repository
cd /var/www
sudo git clone https://github.com/your-username/CustomCraft-QA.git customcraft
cd customcraft

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Set permissions
sudo chown -R www-data:www-data /var/www/customcraft
sudo chmod -R 755 /var/www/customcraft
sudo chmod -R 775 /var/www/customcraft/storage
sudo chmod -R 775 /var/www/customcraft/bootstrap/cache

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate --force
php artisan db:seed --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link
```

### 5. SSL with Let's Encrypt

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Get certificate
sudo certbot --nginx -d your-domain.com

# Auto-renewal
sudo crontab -e
# Add: 0 12 * * * /usr/bin/certbot renew --quiet
```

## 🔧 DigitalOcean Deployment

### 1. Create Droplet

-   Choose Ubuntu 22.04
-   Select appropriate size
-   Add SSH key

### 2. Use DigitalOcean App Platform

Create `app.yaml`:

```yaml
name: customcraft
services:
    - name: web
      source_dir: /
      github:
          repo: your-username/CustomCraft-QA
          branch: main
      run_command: |
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
      environment_slug: php
      instance_count: 1
      instance_size_slug: basic-xxs
      http_port: 8080
      envs:
          - key: APP_NAME
            value: CustomCraft
          - key: APP_ENV
            value: production
          - key: APP_DEBUG
            value: "false"

databases:
    - name: customcraft-db
      engine: MYSQL
      version: "8"
```

## 🚀 Performance Optimization

### 1. Caching

```bash
# Enable OpCache in php.ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=2
```

### 2. Queue Workers

```bash
# Install supervisor
sudo apt install supervisor -y

# Create worker config
sudo nano /etc/supervisor/conf.d/customcraft-worker.conf
```

```ini
[program:customcraft-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/customcraft/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/customcraft/storage/logs/worker.log
```

### 3. Database Optimization

```sql
-- Add indexes for better performance
CREATE INDEX idx_products_name ON products(name);
CREATE INDEX idx_products_active ON products(is_active);
CREATE INDEX idx_portfolios_active ON portfolios(is_active);
```

## 🔒 Security Hardening

### 1. Firewall Configuration

```bash
# Configure UFW
sudo ufw allow ssh
sudo ufw allow 'Nginx Full'
sudo ufw enable
```

### 2. Environment Security

```env
# Use strong passwords
DB_PASSWORD=very-strong-password

# Secure session
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

### 3. Regular Updates

```bash
# Create update script
#!/bin/bash
cd /var/www/customcraft
git pull origin main
composer install --optimize-autoloader --no-dev
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo systemctl reload nginx
```

## 📊 Monitoring

### 1. Log Rotation

```bash
# Configure logrotate
sudo nano /etc/logrotate.d/customcraft
```

```
/var/www/customcraft/storage/logs/*.log {
    daily
    missingok
    rotate 52
    compress
    delaycompress
    notifempty
    create 644 www-data www-data
}
```

### 2. Health Checks

Create monitoring endpoint in `routes/web.php`:

```php
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'database' => DB::connection()->getPdo() ? 'connected' : 'failed'
    ]);
});
```

## 🔄 Backup Strategy

### 1. Database Backup

```bash
#!/bin/bash
# backup.sh
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u username -p password customcraft > /backups/db_backup_$DATE.sql
find /backups -name "db_backup_*.sql" -mtime +7 -delete
```

### 2. File Backup

```bash
#!/bin/bash
# Backup uploads
tar -czf /backups/files_$(date +%Y%m%d).tar.gz /var/www/customcraft/storage/app/public
```

### 3. Automated Backups

```bash
# Add to crontab
0 2 * * * /path/to/backup.sh
```

## ⚡ Troubleshooting

### Common Issues

**Permission Errors**

```bash
sudo chown -R www-data:www-data /var/www/customcraft
sudo chmod -R 775 storage bootstrap/cache
```

**Database Connection**

```bash
# Check MySQL service
sudo systemctl status mysql
sudo systemctl restart mysql
```

**PHP-FPM Issues**

```bash
sudo systemctl status php8.1-fpm
sudo systemctl restart php8.1-fpm
```

**Nginx Configuration**

```bash
sudo nginx -t
sudo systemctl reload nginx
```

This deployment guide should help you get CustomCraft running in production! 🚀
