<?php

namespace App\Validators;

use App\Models\TransferUser;
use App\Repositories\TransferUserRepository;
use Exception;
use Illuminate\Support\Arr;

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
     * Validade payer
     *
     * @return TransferUser
     */
    public function validatePayer()
    {
        $transferUserRepository = new TransferUserRepository();
        $payer = $transferUserRepository->find(Arr::get($this->data, 'payer'));
        if(empty($payer)) {
            throw new Exception("Payer not found.");
        }
        if($payer->document_type !== TransferUser::DOCUMENT_TYPE_CPF) {
            throw new Exception("Only individuals can make transfers.");
        }
        if($payer->wallet->balance - Arr::get($this->data, 'value') < 0) {
            throw new Exception("Insufficient balance for this transfer.");
        }
        return $payer;
    }
    
    /**
     * Validade payee
     *
     * @return TransferUser
     */
    public function validatePayee()
    {
        $transferUserRepository = new TransferUserRepository();
        $payee = $transferUserRepository->find(Arr::get($this->data, 'payee'));
        if(Arr::get($this->data, 'payee') === Arr::get($this->data, 'payer')) {
            throw new Exception("Payee and Payer can not be the same.");
        }
        if(empty($payee)) {
            throw new Exception("Payee not found.");
        }
        return $payee;
    }

}
