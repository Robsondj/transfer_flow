<?php

namespace Tests\Unit;

use App\Models\TransferUser;
use App\Repositories\TransferRepository;
use App\Repositories\TransferUserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateTransferTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Testing if Transfer Repository is creating transfer correctly
     *
     * @return void
     */
    public function test_transfer_repository_is_creating_transfer()
    {
        $transferRepository = new TransferRepository();
        $transferUserRepository = new TransferUserRepository();
        $payer = $transferUserRepository->find($transferUserRepository->findBy('document_type',TransferUser::DOCUMENT_TYPE_CPF)->id);
        $payee = $transferUserRepository->find($transferUserRepository->findBy('document_type',TransferUser::DOCUMENT_TYPE_CNPJ)->id);
        $transfer = $transferRepository->transfer($payer, $payee, 50.5);
        $this->assertNotEmpty($transfer);
    }
}
