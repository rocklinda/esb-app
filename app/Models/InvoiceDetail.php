<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoice_details';
    public $timestamps = true;

    protected $fillable = [
      'invoice_id',
      'item_id',
      'quantity',
      'unit_price',
      'amount',
    ];

    public function invoices()
    {
      return $this->belongsToMany(Invoice::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
