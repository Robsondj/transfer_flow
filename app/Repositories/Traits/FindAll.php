<?php 

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Collection;

trait FindAll 
{

    /**
     * get all data from model
     *
     * @return Collection
     */
    public function findAll()
    {
        return $this->entity->get();
    }
}
