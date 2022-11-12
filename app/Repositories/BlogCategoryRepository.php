<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Get model for edit in admin
     *
     * @param $id
     * @return Model|null
     */
    public function getEdit($id): Model|null
    {
        return $this->startConditions()->find($id);
    }

    /**
     *  Get all categories list for dropdown in admin
     *
     * @return Collection
     */
    public function getForComboBox(): Collection
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_with_title'
        ]);
        dd($this->startConditions()->selectRaw($columns)->toBase()->get());

        return $this->startConditions()->selectRaw($columns)->toBase()->get();
    }

    /**
     * Get all categories by paginate
     *
     * @param $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null): LengthAwarePaginator
    {
        $columns = [
            'id',
            'title',
            'parent_id',
        ];

        return $this->startConditions()->paginate($perPage, $columns);
    }
}
