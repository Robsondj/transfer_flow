<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferUser extends Model
{
    use HasFactory;

    const DOCUMENT_TYPE_CPF = 1;
    const DOCUMENT_TYPE_CNPJ = 2;

    /**
     * get user transfer wallet
     *
     * @return void
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'transfer_user_id');
    }
}
