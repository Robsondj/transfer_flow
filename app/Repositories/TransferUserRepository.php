<?php 

namespace App\Repositories;

use App\Models\TransferUser;
use App\Repositories\Traits\FindAll;

final class TransferUserRepository extends BaseRepository
{

    use FindAll;
    /**
     * create a isntance of TransferUser for entiry
     *
     */
    public function __construct()
    {
        parent::__construct(new TransferUser());
    }
}