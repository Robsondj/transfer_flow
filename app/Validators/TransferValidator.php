<?php

namespace App\Validators;

use App\Models\TransferUser;
use Exception;

class TransferValidator extends BaseValidator
{

    /**
     * Get the validation rules that apply to the data.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payer' => 'required|numeric',
            'payee' => 'required|numeric',
            'value' => 'required|numeric',
        ];
    }

    /**
     * Validade users and value
     *
     * @param TransferUser $payer
     * @param TransferUser $payee
     * @param float $value
     * @return void
     */
    public function validateUsers(TransferUser $payer, TransferUser $payee, $value)
    {
        if($payer->document_type !== TransferUser::DOCUMENT_TYPE_CPF) {
            throw new Exception("Somente pessoa física pode fazer transferências.");
        }
        if($payer->wallet->balance - $value < 0) {
            throw new Exception("Saldo insuficiente para essa transferência.");
        }
        return true;
    }

}
