## Cài đặt

- Tạo thư mục lưu các thông tin liên quan đến dự án: `$ mkdir -p proj_cms` 
- `$ cd proj_cms`
- `$ git clone git@gitlab.com:rikkei-training-2020/zeni-cms.git cms_zeni`
- `$ git clone git@gitlab.com:rikkei-training-2020/php-devops.git alpineweb`
- `$ cp alpineweb/env-example alpineweb/.env`
- `$ cd alpineweb`
- Sửa file .env với giá trị sau `APP_CODE_PATH_HOST=../cms_zeni`
- `$ docker-compose build`
- `$ docker-compose up -d`
- `$ cd ../cms_zeni`
- `$ cp .env.example .env`
- `$ docker exec -it -u www-data alpineweb /bin/sh`
- `$ composer install`
- `$ php artisan key:generate --ansi`
- `$ php artisan config:cache`
- `$ npm install`
- `$ npm run dev`
- Truy cập http://localhost:8000/admin

## Một số câu lệnh thường dùng 

- `$ docker exec -it -u www-data alpineweb php artisan config:cache`
- `$ docker exec -it -u www-data alpineweb php artisan migrate`
- Truy cập webserver: `$ docker exec -it -u www-data alpineweb /bin/sh`

## Truy cập database dựa vào thông tin sau:
- DB_HOST=localhost
- DB_PORT=33060
- DB_DATABASE=laravel
- DB_USERNAME=dbuser1
- DB_PASSWORD=dbuser1
