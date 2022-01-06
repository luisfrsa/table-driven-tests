<?php

namespace Src;

class MyClass
{

    private IDBRepository $db_repository;

    public function __construct(IDBRepository $db_repository)
    {
        $this->db_repository = $db_repository;
    }

    /**
     * domain constraints:
     *  - inputs should be positive or zero
     *  - inputs should be < 1000
     * features:
     *  - the result should be stored in the (fake) database
     */
    public function criticalImportantFunction(int $a, int $b): int
    {
        if ($a < 0 or $b < 0) {
            throw new \DomainException("A and B should be positive numbers");
        }
        if ($a > 1000 or $b > 1000) {
            throw new \DomainException("A and B should be <= than 1000");
        }
        $result = $a + $b;
        $this->db_repository->save($result);
        return $result;
    }
}

