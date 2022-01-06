<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    public $timestamps = true;

    protected $fillable = [
        'item_type',
        'supplier_id',
        'description',
        'unit_price'
    ];
}
