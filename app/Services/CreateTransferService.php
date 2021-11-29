<?php

namespace App\Services;

use App\Validators\TransferValidator;
use App\Repositories\TransferRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class CreateTransferService implements ServiceInterface
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
        $payer = $transferValidator->validatePayer();
        $payee = $transferValidator->validatePayee();
        
        $transferRepository = new TransferRepository();

        DB::beginTransaction();
        $transfer = $transferRepository->transfer($payer, $payee, Arr::get($data, 'value'));

        if(empty($transfer) || !AuthorizeTransactionService::run()) {
            DB::rollBack();
            throw new Exception("Unauthorized transaction.");
        }
        DB::commit();
        return true;
    }
    
}
