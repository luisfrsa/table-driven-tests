<?php


use PHPUnit\Framework\TestCase;

# ./vendor/bin/phpunit src/NumberTableTest.php --bootstrap ./vendor/autoload.php
class NumberTableTest extends TestCase {

   /** @dataProvider addDataProvider */
   public function testAdd(int $first, int $second, int $expected) {
    $result = Number::add($first, $second);
    $this->assertEquals($expected, $result);
   }

   public function addDataProvider() {
       return [
           '#0 should add zero and zero'=>['first'=>0, 'second'=>0,'expected'=>0],
           '#1 should add zero and one'=>['first'=>0, 'second'=>1,'expected'=>1],
           '#2 should add negative numbers'=>['first'=>-5, 'second'=>-3,'expected'=>-8],
           '#3 should add negative and positive numbers'=>['first'=>-2, 'second'=>3,'expected'=>1]
       ];
    }

   public function testInvalidArguments() {
    $this->expectException(\TypeError::class);
     Number::add(null, null);
    }
}