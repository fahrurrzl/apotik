<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
