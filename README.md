# beautifulCode
##### This repo contains the major project-2 code base, the semester registration portal using php's _laravel framework_

Steps to fork and getting this to work along with laravel:

```bash
$ git fork https://github.com/prateekprshr-nith/beautifulCode.git
$ cd beautifulCode/semesterRegistration
$ composer install
```

To migrate the database tables, do your proper settings in .env file and run
```bash
$ php artisan migrate
$ php artisan db:seed
```

Happy Programming :)
