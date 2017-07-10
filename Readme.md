Requirements
------------
* PHP 5.6.17+
* composer

Installation
------------
* Clone the repository
```sh
git clone https://github.com/rogelio-meza-t/php_user_example.git
```

* Enter to the working directory
```sh
cd working/path/php_user_example
```

* Install required dependencies
```sh
composer install
```

Run the server
-------------
* Start the built-in server
```sh
php -S localhost:4000
```
* Go to the browser and navigate to http://localhost:4000

If you get a `404 Not Found` you are ok, because the root path is not defined

Working with users
-----------------

By default, there are 4 users, each one with one role defined:

|User|Pass|Role|
|----|:--:|----|
|user_one|1234|PAGE_1|
|user_two|1234|PAGE_2|
|user_three|1234|PAGE_3|
|admin|1234|ADMIN|

The sign in page is
```sh
localhost:4000/sign_in
```

While the private page are:

|privates pages|
|:--------------------:|
|localhost:4000/page/1|
|localhost:4000/page/2|
|localhost:4000/page/3|

Working with the API
--------------------

* Show user info example:
```sh
localhost:4000/api/users/1/show
```

returns

```json
{
  "id": "1",
  "username": "user_one_two",
  "roles": [
    "PAGE_1"
  ]
}
```

* Edit user info
```sh
localhost:4000/api/users/1/edit
