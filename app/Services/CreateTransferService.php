<?php

namespace App\Services;

use App\Validators\TransferValidator;
use App\Repositories\TransferUserRepository;
use Illuminate\Support\Arr;

final class CreateTransferService implements InterfaceService
{

    /**
     * Create a transfer between users
     *
     * @param array $data
     * @return void
     */
    public static function run($data): bool 
    {
        $transferValidator = new TransferValidator($data);
        $transferValidator->validate();

        $transferUserRepository = new TransferUserRepository();
        $payer = $transferUserRepository->find(Arr::get($data, 'payer'));
        $payee = $transferUserRepository->find(Arr::get($data, 'payee'));
        $transferValidator->validateUsers($payer->first(), $payee->first(), Arr::get($data, 'value'));
        return true;
    }
    
}
