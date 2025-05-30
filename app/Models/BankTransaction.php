<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

   protected $guarded = [];

    // public function bank_account()
    // {
    //     return $this->belongsTo(BankAccount::class, 'bank_id');
    // }

    // public function to_bank_account()
    // {
    //     return $this->belongsTo(BankAccount::class, 'to_bank_id');
    // }

    // public function from_bank_account()
    // {
    //     return $this->belongsTo(BankAccount::class, 'from_bank_id');
    // }

    // public function expense()
    // {
    //     return $this->belongsTo(Expense::class);
    // }

    // public function invoice()
    // {
    //     return $this->belongsTo(Invoice::class);
    // }

    // public function purchase()
    // {
    //     return $this->belongsTo(Purchase::class);
    // }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}