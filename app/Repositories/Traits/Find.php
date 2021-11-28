<?php 

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Collection;

trait Find
{

    /**
     * get all data from model
     *
     * @return Collection
     */
    public function find($id)
    {
        return $this->entity->find($id);
    }
}