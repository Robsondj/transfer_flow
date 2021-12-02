<?php 

namespace App\Repositories;

use App\Models\TransferUser;
use App\Repositories\Traits\Find;
use App\Repositories\Traits\FindBy;

final class TransferUserRepository extends BaseRepository
{

    use Find, FindBy;
    /**
     * create a isntance of TransferUser for entity
     *
     */
    public function __construct()
    {
        parent::__construct(new TransferUser());
    }

}
