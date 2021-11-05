## Dockerized Laravel App

<div dir="rtl">
سیستم ثبت‌نام برای جشن فارغ التحصیلان دانشگاه یزد.

این برنامه از درگاه پرداخت آیدی پی (IDpay) برای امور مالی استفاده می‌کند. شما میتوانید با وارد کردن توکن خود که از درگاه پرداخت مذکور گرفته اید، در فایل `.env` اتصال را برقرار کنید.

هنوز این برنامه پنل مدیریتی نداره. ولی در آينده براش خواهم نوشت. اگر دوست داشتین، شما بنویسین و برام PR بزنین!

</div>

## Usage

Registration Code: `UNi1400YZD`

Students Reports: `<YourDomain>/report/students/YazdUniGetReport1400`

Hamrahan Reports: `<YourDomain>/report/hamrahan/YazdUniGetReport1400`

## Setup

Make sure you have docker and docker compose on your machine.

[How To Install and Use Docker on Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04)

[How To Install Docker Compose on Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-docker-compose-on-ubuntu-18-04)

Clone the project

`cd` into the project directory

Run `cp source/.env.example source/.env`

Run `docker-compose up -d`

This will build three docker container

app, db, nginx, phpmyadmin

Generate app key

```
docker-compose exec app php artisan key:generate
```

Cache configurations
```
docker-compose exec app php artisan config:cache
```

Enter the database and login to mysql
```
docker-compose exec db bash

mysql -p
```
make use of the password defined inside the `docker-compose.yml` file.

