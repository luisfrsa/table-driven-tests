<?php

namespace Src;

use PHPUnit\Framework\TestCase;

class MyClassTest extends TestCase
{

    private $db_repository;
    private MyClass $my_class;

    public function setup(): void
    {
        $this->db_repository = $this->createMock(IDBRepository::class);
        $this->my_class = new MyClass($this->db_repository);
    }

    public function testZeroAndZero()
    {
        $expected = 0;
        $this->db_repository->expects($this->once())->method('save')->with($expected);
        $result = $this->my_class->criticalImportantFunction(0, 0);
        $this->assertEquals($expected, $result);
    }

    public function testZeroAndOne()
    {
        $expected = 1;
        $this->db_repository->expects($this->once())->method('save')->with($expected);
        $result = $this->my_class->criticalImportantFunction(0, 1);
        $this->assertEquals($expected, $result);
    }

    public function testInverseOneAndZero()
    {
        $expected = 1;
        $this->db_repository->expects($this->once())->method('save')->with($expected);
        $result = $this->my_class->criticalImportantFunction(1, 0);
        $this->assertEquals($expected, $result);
    }

    public function testOneAndTwo()
    {
        $expected = 3;
        $this->db_repository->expects($this->once())->method('save')->with($expected);
        $result = $this->my_class->criticalImportantFunction(1, 2);
        $this->assertEquals($expected, $result);
    }

    public function testInvalidArgumentType()
    {
        $this->expectException(\TypeError::class);
        $this->db_repository->expects($this->never())->method('save');
        $this->my_class->criticalImportantFunction('a string', 0);

    }

    public function testNegativeNumbers()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("A and B should be positive numbers");
        $this->db_repository->expects($this->never())->method('save');
        $this->my_class->criticalImportantFunction(-1, 1);

    }

    public function testNumbersGteThan1000()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("A and B should be <= than 1000");
        $this->db_repository->expects($this->never())->method('save');
        $this->my_class->criticalImportantFunction(1, 1001);

    }

}