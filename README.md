<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## langkah pindah server

a. Download laravel
b. ubah vue to react
  - $php artisan preset react
  - $npm install && npm dev -> pake node.js
c. buat server redist

1. buat file .env, set pengaturan database dan set driver redist
<p>
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=********
  DB_USERNAME=********
  DB_PASSWORD=********

  BROADCAST_DRIVER=redis
  CACHE_DRIVER=file
  SESSION_DRIVER=file
  SESSION_LIFETIME=120
  QUEUE_DRIVER=redis

  REDIS_HOST=127.0.0.1
  REDIS_PASSWORD=null
  REDIS_PORT=6379
</p>
2. $php artisan make:auth
3. copy folder dan file
    /database/migrations
    /app/helpers/
    /app/Models/
    /app/Event/
    /app/Http/Controller/
    /public/
    /resources/views
    /resources/assets/js/components
    /resources/assets/js/app.js
    /route/api.php
    /route/web.php

4. Migrate data base $php artisan migrate
5. tambahkan "app/helpers" pada autoload>classmap di file composer.json
5b. edit file composer.json pada root: tambahkan
    <p>
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        },
        "classmap": [
            "database/seeds",
            "database/factories",
            "app/helpers"
        ]
    },
    </p>
<!-- 5c. $ composer dump-autoload  -->
6. composer require ramsey/uuid
  composer require box/spout
7. composer require barryvdh/laravel-dompdf
    * set file /config/app.php
    - Barryvdh\DomPDF\ServiceProvider::class,
    - 'PDF' => Barryvdh\DomPDF\Facade::class,
8. copy file /public/.htaccess ke root folder
9. ubah nama file server.php pada root folder menjadi index.php
10. edit file /Illuminate/Routing/UrlGenerator.php
  <!-- public function asset($path, $secure = null)
  {
     ......
     return $this->removeIndex($root).'/'.trim($path, '/');
  }
  - menjadi
  public function asset($path, $secure = null)
  {
     ......
     return $this->removeIndex($root).'/public/'.trim($path, '/');
  } -->

* ikuti langkah https://commit-cyber.com/stories/powerful-real-time-web-applications-dengan-laravel-react-socketio-redis-vyMhpihbQW
11. instal paket pendukung realtime
    - $ composer require predis/predis
    - $ npm install --save socket.io-client laravel-echo
    - $ npm install -g laravel-echo-server
    - $ npm install --save uuid
    - $ npm install --save moment react-moment
    - $ npm install --save moment-timezone
    - $ npm run dev
    - $ npm run watch
    - $ laravel-echo-server init

12. pada resources>asset>js>bootstrap.js tambahkan script:
    <p>
    import Echo from 'laravel-echo'
    window.io = require('socket.io-client');

    window.Echo = new Echo({
        broadcaster: 'socket.io',
        // host: window.location.hostname + ':6001'
        host: 'http://localhost:6001'
    });
    </p>

13. jalnkan server

  $php artisan queue:work
  $laravel-echo-server start
