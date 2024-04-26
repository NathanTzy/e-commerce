<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'user_id',
        'product_id'
    ];

    public function transaction(){
        return $this->belongsTo(transaction::class);
    }
    public function product(){
        return $this->belongsTo(product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
