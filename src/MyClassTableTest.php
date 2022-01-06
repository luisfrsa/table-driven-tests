<?php

namespace Src;

use PHPUnit\Framework\TestCase;

class MyClassTableTest extends TestCase
{

    private $db_repository;
    private MyClass $my_class;

    public function setup(): void
    {
        $this->db_repository = $this->createMock(IDBRepository::class);
        $this->my_class = new MyClass($this->db_repository);
    }

    /** @dataProvider happyPathDataProvider */
    public function testHappyPath(int $a, int $b, int $expected)
    {
        $this->db_repository->expects($this->once())->method('save')->with($expected);
        $result = $this->my_class->criticalImportantFunction($a, $b);
        $this->assertEquals($expected, $result);
    }

    public function happyPathDataProvider()
    {
        return [
            '#0 should test zero and zero' => [
                'a' => 0, 'b' => 0, 'expected' => 0
            ],
            '#1 should test zero and one' => [
                'a' => 0, 'b' => 1, 'expected' => 1
            ],
            '#2 should test one and zero (different args)' => [
                'a' => 1, 'b' => 0, 'expected' => 1
            ],
            '#3 should test one and two' => [
                'a' => 1, 'b' => 2, 'expected' => 3
            ],
        ];
    }

    public function testInvalidArgumentType()
    {
        $this->expectException(\TypeError::class);
        $this->db_repository->expects($this->never())->method('save');
        $this->my_class->criticalImportantFunction('a string', 0);
    }


    public function domainExceptionsDataProvider()
    {
        return [
            '#0 should test negative numbers' => [
                'a' => -1,
                'b' => 1,
                'message'=>"A and B should be positive numbers",
            ],
            '#1 should test numbers greater than 1000' => [
                'a' => 1,
                'b' => 1001,
                'message'=>"A and B should be <= than 1000",
            ],

        ];
    }


    /** @dataProvider domainExceptionsDataProvider */
    public function testDomainExceptions(int $a, int $b, string $message)
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage($message);
        $this->db_repository->expects($this->never())->method('save');
        $this->my_class->criticalImportantFunction($a, $b);
    }
}