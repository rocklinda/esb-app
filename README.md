<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# _CRUD Invoice_

## Installation
### .Env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=esb_app
DB_USERNAME=root
DB_PASSWORD=
```
### Migrate Database
```
php artisan migrate:fresh --seed
```

### Run Application
```
php artisan serve
```

### URL CRUD Invoice
```
http://127.0.0.1:8000/invoices
```

### API Get All Data
```
http://127.0.0.1:8000/api/invoices
```

### API Get One Data
```
http://127.0.0.1:8000/api/invoices/{id}
```
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
