composer install;

composer dump-autoload;

./vendor/bin/phpunit src/MyClassTest.php --bootstrap ./vendor/autoload.php
./vendor/bin/phpunit src/MyClassTableTest.php --bootstrap ./vendor/autoload.php
