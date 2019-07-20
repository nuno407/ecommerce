# Welcome to ecommerce platform

The purpose of this repository is to test Symphony PHP framework. 
The test consists on the creation of a simple backend service exposing a REST API(please check [API definition](./API.yaml)) that will enable the creation of a simple e-commerce application.

The backend should be able to be used by mobile and web application providing, for now, the following features:

* Users should be able to create an client account.
* Users should be able to add different products to their cart.
* users should be able to add a shipping and billing address.
* Administrator accounts should be able to set the quantity of the products.
* Administrators should be able to create platform-wide discounts.
* Users should have the option to add discount coupon to their cart.
* The product, user list, discount list and cart content should allow "infinite scrolling". Pagination?

## Database schema

![database](https://www.lucidchart.com/publicSegments/view/865fab47-8666-4d2d-ab84-c07d83dc6737/image.png)



## Machine Setup


A windows 10 machine with ubuntu sub-runtime was used in this setup.


### Install php:


sudo apt-get install php

sudo apt-get install php-pear php7.2-curl php7.2-dev php7.2-gd php7.2-mbstring php7.2-zip php7.2-mysql php7.2-xml

sudo apt install php-sqlite3

__Note:__For this project is used an sqlite database for easiness of development. Should be easy to use another database backend since we use "symfony/orm-pack"


### Install composer:


php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

php composer-setup.php

php -r "unlink('composer-setup.php');"


### Install Symphony Framework


wget https://get.symfony.com/cli/installer -O - | bash


### Install dependencies (npm install)


composer install






## Setup Project


Steps done to cretae the project


## Commands used during project


Multiple commands using during project setup


### Create database and schema


php bin/console doctrine:database:create

php bin/console doctrine:schema:create


### Create entities and controllers

php bin/console make:entity

php bin/console generate:controller




## Production Packages

symfony/orm-pack -> ORM for database mapping

symfony/validator -> vslidation of input 

jms/serializer-bundle -> serialize

friendsofsymfony/rest-bundle -> rest API creation

friendsofsymfony/user-bundle -> User authentication

friendsofsymfony/oauth-server-bundle -> User authentication