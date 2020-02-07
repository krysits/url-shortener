0k.lv url-shortener
-------------------

Demo: https://0k.lv

Author: Kristaps Lediņš aka @krysits.COM

Tech: PHP7, MySQL, Javascript, CSS3, HTML5

Modified: 2020-02-07

License: GPLv3

---

Install:
 1) set up MySQL server connection in `.env` file as:
 
```
DB_TYPE=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<YourDatabaseName>
DB_USERNAME=<YourUsername>
DB_PASSWORD=<YourPassword>

SALT=<YourSaltPhrase>
```
 
 2) run `composer install` command
 3) import `db.sql` file into your database
 4) configure Apache server to `public` folder as document root
 5) Try It!

---
&copy; 2020 All rights reserved.

https://0k.lv/skeletony