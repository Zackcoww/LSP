#!/bin/bash

# Exit on error
set -e

# 1. Install Docker & Docker Compose
echo "[+] Installing Docker..."
sudo apt-get update
sudo apt-get install -y ca-certificates curl gnupg lsb-release
sudo mkdir -p /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | \
  sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] \
  https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
sudo systemctl enable docker
sudo systemctl start docker
sudo docker version

# 1. Docker daemon config (DNS + MTU)
echo "[+] Configuring Docker daemon DNS and MTU..."
cat <<EOF | sudo tee /etc/docker/daemon.json
{
  "dns": ["8.8.8.8", "1.1.1.1"],
  "mtu": 1400
}
EOF

# Restart Docker to apply settings
sudo systemctl restart docker


# 2. Clone Laravel project
cd ~
git clone https://github.com/Zackcoww/LSP.git

# 3. Create Dockerfile
cat <<'EOF' > Dockerfile
FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY ./toko-buah /var/www
RUN cp .env.example .env
RUN composer install

CMD ["php-fpm"]
EOF

# 4. Create docker-compose.yaml
cat <<'EOF' > docker-compose.yaml
services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: laravel_app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./toko-buah:/var/www
    networks:
      - laravel

  webserver:
    image: nginx:alpine
    container_name: nginx_server
    ports:
      - "80:80"
    volumes:
      - ./toko-buah:/var/www
      - ./default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app
    networks:
      - laravel

  db: 
    image: mysql:8.0
    container_name: mysql_db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: dbbuahsayur
      MYSQL_USER: toko
      MYSQL_PASSWORD: toko
      MYSQL_ROOT_PASSWORD: root
    volumes:
      - db_data:/var/lib/mysql
    networks:
      - laravel

volumes:
  db_data:

networks:
  laravel
EOF

# 5. Create default.conf
cat <<'EOF' > default.conf
server {
    listen 80;
    index index.php index.html;
    root /var/www/public;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass laravel_app:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME /var/www/public\$fastcgi_script_name;
        include fastcgi_params;
    }
}
EOF

# 6. Start containers
echo "[+] Starting containers..."
sudo docker compose up -d --build

# 7. Wait for DB to be ready
echo "[*] Waiting for MySQL to initialize..."
sleep 20

# 8. Laravel post-setup
echo "[+] Running Laravel commands..."
sudo docker exec -it laravel_app composer install
sudo docker exec -it laravel_app php artisan key:generate

#sudo docker exec -it laravel_app composer require tymon/jwt-auth
#sudo docker exec -it laravel_app php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

sudo docker exec -it laravel_app php artisan jwt:secret
sudo docker exec -it laravel_app php artisan migrate:fresh
sudo docker exec -it laravel_app php artisan db:seed
sudo docker exec -it chown -R www-data:www-data www/

echo "[✔] Done"