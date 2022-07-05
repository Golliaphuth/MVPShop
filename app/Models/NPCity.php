<?php

namespace App\Models;

class NPCity
{
    public function __construct($data)
    {
        foreach($data as $property => $value) {
            $this->$property = $value;
        }
        return $this;
    }
}
