<?php

namespace Advans\Api\CatalogosCFDI;

class CustomWhere {

    protected $where;
    protected $data;

    public function __construct($where, $data) {
        $this->where = $where;
        $this->data = $data;
    }

    public function getWhere() {
        return $this->where;
    }

    public function getData() {
        return $this->data;
    }

    public function parse() {
        $where = $this->where;
        foreach ($this->data as $key => $value) {
            $where = str_replace(':' . $key, json_encode($value), $where);
        }
        return $where;
    }
}