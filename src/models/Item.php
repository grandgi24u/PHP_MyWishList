<?php

namespace mywishlist\models;

class Item extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'item';
    protected $primaryKey = 'id';
    public $timestamps = false;

}