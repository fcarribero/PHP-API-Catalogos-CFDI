<?php

namespace Advans\Api\CatalogosCFDI;

class CustomWhere {

    protected $where;

    public function __construct($where) {
        $this->where = $where;
    }

    public function getWhere() {
        return $this->where;
    }
}