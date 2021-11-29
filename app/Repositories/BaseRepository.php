<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository 
{

    /**
     * entity model
     *
     * @var Model
     */
    protected $entity;

    /**
     * create a isntance of Model for entity
     *
     * @param Model $entity
     */
    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }
}
