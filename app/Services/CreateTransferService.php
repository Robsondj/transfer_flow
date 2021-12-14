<?php

namespace App\Services;

use App\Jobs\Email;
use App\Repositories\BaseRepository;
use App\Validators\TransferValidator;
use App\Repositories\TransferRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class CreateTransferService implements ServiceInterface
{

    /**
     *
     * @var TransferRepository
     */
    private $transferRepository = null;

    public function __construct(TransferRepository $transferRepository)
    {
        $this->transferRepository = $transferRepository;
    }

    /**
     * Create a transfer between users
     *
     * @param array $data
     * @return void
     */
    public function run($data): bool
    {
        $transferValidator = new TransferValidator($data);
        $transferValidator->validate();
        $payer = $transferValidator->validatePayer();
        $payee = $transferValidator->validatePayee();

        if (empty($transfer) || !AuthorizeTransactionService::run()) {
            throw new Exception("Unauthorized transaction.");
        }
        $transfer = $this->transferRepository->transfer($payer, $payee, Arr::get($data, 'value'));

        Email::dispatch($payee->email);

        return true;
    }
}
