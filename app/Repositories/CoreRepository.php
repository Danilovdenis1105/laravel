<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 *  Class CoreRepository
 *
 * Репозиторий для работы с сущностью.
 * Может возвращать наборы данных
 * Не может создавать/ищменять сущность
 */
abstract class CoreRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass(): string;

    protected function startConditions()
    {
        return clone $this->model;
    }
}
