# beautifulCode
##### This repo contains the code base for my B.Tech. major project, the semester registration portal using php's _laravel framework_

Steps to fork and getting this to work along with laravel:

```bash
$ git clone https://github.com/prateekprshr-nith/beautifulCode.git
$ cd beautifulCode/semesterRegistration
$ composer install
$ php artisan key:generate
```

To migrate the database tables, do your proper settings in .env file and run
```bash
$ php artisan migrate:refresh --seed
$ php artisan db:seed --class=UserTablesSeeder # Optional, just for testing purposes 
```

Also install following external libraries
```bash
$ sudo apt-get install wkhtmltopdf
```
Happy Programming :)
