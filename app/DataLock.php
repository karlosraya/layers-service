<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataLock extends Model
{
 	protected $fillable = ['id', 'type', 'lockDate', 'feeds', 'ungraded', 'pww', 'pw', 'pullets', 'small', 'medium', 'large', 'extraLarge', 'jumbo', 'crack', 'spoiled', 'lastInsertUpdateBy', 'lastInsertUpdateTS'];

    public $timestamps = false;
}
