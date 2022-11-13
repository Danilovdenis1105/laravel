<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{

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
     * Get all posts by paginate
     *
     * @param $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null): LengthAwarePaginator
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        return $this->startConditions()
            ->orderBy('id', 'DESC')
//            ->with(['category', 'user'])
            ->with([
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                'user:id,name',
            ])
            ->paginate($perPage, $columns);
    }
}
