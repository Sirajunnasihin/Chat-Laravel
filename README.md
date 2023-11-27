# AddChat Laravel

# Laravel Installation

AddChat can be installed via composer. Smooth... 🍻


## Prerequisites

* Laravel version 5.5 / 5.6 / 5.7 / 5.8 / 6.x
* Make sure to install AddChat package on a **Fresh** or **Existing** Laravel application. 
* We also assume that you've setup the database.
* If you're running MySql version older than < 5.7 then disable strict mode in Laravel `config/database.php` `'strict' => false`


## Install

1. If installing AddChat on an existing Laravel application and you already have **Auth** system then **skip this step**

    If installing on a **Fresh Laravel application** then run 

    **For Laravel 5.5 to 5.8**

    ```php
    php artisan make:auth

    php artisan migrate
    ```

    **For Laravel 6.x**

    ```php
    composer require laravel/ui --dev

    php artisan ui vue --auth

    npm install && npm run dev

    php artisan migrate
    ```


2. Unzip the `addchat-laravel-pro.zip` file, copy the `addchat-laravel-pro` folder and place it in your Laravel application root directory.

    - The folder name must be `addchat-laravel-pro` in your Laravel website directory.
    

3. Open your Laravel application `composer.json` file and paste the below code in the end (right before last curly `}` bracket)

    ```json
    "repositories": [{
        "type": "path",
        "url": "addchat-laravel-pro/"
    }]
    ```

4. Install AddChat Laravel Pro via Composer

    ```php
    composer require classiebit/addchat-laravel-pro
    ```

5. Run AddChat install command

    ```php
    php artisan addchat:install
    ```
6. Open the common layout file, mostly the common layout file is the file which contains the HTML & BODY tags.

    - Copy AddChat CSS code and paste it right before closing **&lt;/head&gt;** tag

        ```php
        <!-- 1. Addchat css -->
        <link href="<?php echo asset('assets/addchat/css/addchat.min.css') ?>" rel="stylesheet">
        ```
    
    - Copy AddChat Widget code and paste it right after opening **&lt;body&gt;** tag

        ```php
        <!-- 2. AddChat widget -->
        <div id="addchat_app" 
            data-baseurl="<?php echo url('') ?>"
            data-csrfname="<?php echo 'X-CSRF-Token' ?>"
            data-csrftoken="<?php echo csrf_token() ?>"
        ></div>
        ```

    - Copy AddChat JS code and paste it right before closing **&lt;/body&gt;** tag

        ```php
        <!-- 3. AddChat JS -->
        <!-- Modern browsers -->
        <script type="module" src="<?php echo asset('assets/addchat/js/addchat.min.js') ?>"></script>
        <!-- Fallback support for Older browsers -->
        <script nomodule src="<?php echo asset('assets/addchat/js/addchat-legacy.min.js') ?>"></script>
        ```

    - Please replace **&lt;php ?>** tag by **{{}}** curly brackets.


    #### The final layout will look something like this

    ```php
    <head>

        <!-- **** your site other content **** -->

        <!-- 1. Addchat css -->
        <link href="<?php echo asset('assets/addchat/css/addchat.min.css') ?>" rel="stylesheet">

    </head>
    <body>

        <!-- 2. AddChat widget -->
        <div id="addchat_app" 
            data-baseurl="<?php echo url('') ?>"
            data-csrfname="<?php echo 'X-CSRF-Token' ?>"
            data-csrftoken="<?php echo csrf_token() ?>"
        ></div>


        
        <!-- **** your site other content **** -->



        <!-- 3. AddChat JS -->
        <!-- 3. AddChat JS -->
        <!-- Modern browsers -->
        <script type="module" src="<?php echo asset('assets/addchat/js/addchat.min.js') ?>"></script>
        <!-- Fallback support for Older browsers -->
        <script nomodule src="<?php echo asset('assets/addchat/js/addchat-legacy.min.js') ?>"></script>

    </body>
    ```

- `addchat.min.js` for modern browsers & `addchat-legacy.min.js` for older browsers. These will be used switched by the browsers automatically on the basis on `type="module"` & `nomodule`, you need to nothing.

---


Setup finishes here, now heads-up straight to **[Settings](https://addchat-pro-docs.classiebit.com/docs/1.0/admin/settings)** docs
