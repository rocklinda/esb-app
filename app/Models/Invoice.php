<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    public $timestamps = true;

    protected $fillable = [
        'supplier_id',
        'customer_id',
        'company_id',
        'issue_date',
        'due_date',
        'subject',
        'subtotal',
        'tax',
        'payment'
    ];

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
