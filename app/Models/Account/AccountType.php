<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
