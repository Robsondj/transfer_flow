<?php 

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Collection;

trait FindBy
{

    /**
     * get all data from model
     *
     * @return Collection
     */
    public function findBy($field, $value)
    {
        return $this->entity->where($field, '=', $value)->first();
    }
}
