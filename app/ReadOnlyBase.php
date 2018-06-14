<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class ReadOnlyBase
{
    protected $titles = [];

    public function all()
    {
    	return $this->titles;
    }

    public function get($id)
    {
    	return $this->titles[$id];
    }
}
