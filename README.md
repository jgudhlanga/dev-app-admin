<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Install

Remember to change the env file to your database details. 

``` bash
git clone https://github.com/jgudhlanga/dev-app-admin.git
chmod -R 777 /storage /bootstrap/cache
cp .env.example .env
composer install
npm install
php artisan migrate --seed
php artisan storage:link
php artisan key:generate
npm run dev

```

## Queue Process Jobs

``` bash
php artisan queue:work --daemon --database --queue=high,medium,low --delay=20 --tries=10
```

### Important

Do not commit the following files to the git repo as they are all dynamically generated 
and might overwrite others settings.
 
``` 
.env
node_modules
vendor
public/build
public/css
public/js
public/vendor
public/fonts
```
## Credits

- James Gudhlanga
- All Contributors
