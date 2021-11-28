<?php

namespace App\Services;

use App\Repositories\TransferUserRepository;

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
        $transferUserRepository = new TransferUserRepository();
        return true;
    }
    
}
