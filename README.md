![Show Case](https://i.ibb.co/Mhryxcy/Todo-App-Preview-1.png)

# Todo App

Self Hosted Simple Looking Todo Application, powered by Open Source framework such as Laravel + Admin LTE, customizable
also beginner will easily understand the flow and the structure of this application

## Demo

- Host : https://todo.supanadit.com
- Email : admin@email.com
- Password : 123

## Requirement

- PHP 7.4+
- Laravel 7.2.5+

## Quick Start

- create a database called `todo` or whatever you want
- create `.env` file
- setup database configuration at `.env` file
- `composer install`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan serve`

#### Apache Configuration for Virtual Host

```apacheconfig
<VirtualHost *:80>
    DocumentRoot "/srv/http/todo/public"
    
    ServerAdmin webmaster@localhost
    ServerName todo.test
    
    <Directory "/srv/http/todo/public">
        DirectoryIndex index.php
        AllowOverride All
        Options FollowSymlinks
        Require all granted
    </Directory>
    
    ErrorLog "/var/log/httpd/todo.test-error_log"
    CustomLog "/var/log/httpd/todo.test-access_log" common
</VirtualHost>
```

## Docker Way

This app can run inside docker with official support

### Via Docker Compose

```bash
docker-compose up -d
```

### Run Migration

```bash
docker-compose exec todo-app php artisan migrate
```

### Run Seeder

```bash
docker-compose exec todo-app php artisan db:seed
```

### Troubleshooting MySQL Won't Run In Docker

Run this script `sudo chown -R 1001:1001 mysql`

Because we used Bitnami distribution version of MySQL, so we need to change the permission of mysql folder, since it
also described in docker page of bitnami

## Note

If you want to use forgot password feature, you must provide your email and password at `.env`

## Support

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/N4N01CIMZ)

## License

Copyright 2020 Supan Adit Pratama

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the
License. You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "
AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific
language governing permissions and limitations under the License.
