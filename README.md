# Admin App - Assessment 

> ### This is an assessment by Cypress

---

# Getting started

## Installation

Please check the official laravel 7 installation guide for installing via composer before you start. [Official Documentation](https://laravel.com/docs/7.x/installation#installation-via-composer)

**Open the bash terminal**

Clone the repository

```
git clone https://github.com/beisong7/admin-user-activity.git
```

Switch to the repo folder

```
cd admin-user-activity
```

Install all the dependencies using composer

```
composer install
```

Copy the example env file and make the required configuration changes in the .env file 

- you would need to run `php artisan key:gen` and `php artisan jwt:secret`

```
cp .env.example .env
```

**Extracting the assets zip for the UI**

    cd public
    unzip assets.zip -d assets
    cd ..

Run the database migrations (**Set the database connection in .env before migrating**) and seed the default users and configurations

-   `.env` - Environment variables (such as database name) can be set in this file

```
php artisan migrate --seed
```


Serve the application

```
php artisan serve
```

**TL;DR command list**

    git clone https://github.com/beisong7/admin-user-activity.git
    cd admin-user-activity
    composer install --ignore-platform-reqs
    cp .env.example .env
    cd public
    unzip assets.zip -d assets
    cd ..
    php artisan migrate --seed
    php artisan key:gen
    php artisan jwt:secret
    php artisan serve
