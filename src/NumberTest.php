<?php


use PHPUnit\Framework\TestCase;

# ./vendor/bin/phpunit src/NumberTest.php --bootstrap ./vendor/autoload.php
class NumberTest extends TestCase {

   
    public function testAddZeroAndZero(){
        $expected = 0;
        $result = Number::add(0,0);
        $this->assertEquals($expected, $result);
    }

    public function testAddZeroAndOne(){
        $expected = 1;
        $result = Number::add(0,1);
        $this->assertEquals($expected, $result);
    }


    public function testAddNegativeNumbers(){
        $expected = -8;
        $result = Number::add(-5,-3);
        $this->assertEquals($expected, $result);
    }


    public function testAddNegativeAndPositiveNumbers(){
        $expected = 1;
        $result = Number::add(-2,3);
        $this->assertEquals($expected, $result);
    }


    public function testAdd(){
        $this->expectException(\TypeError::class);
         Number::add(null, null);
    }
}