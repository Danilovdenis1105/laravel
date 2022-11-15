<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends BaseController
{
    private BlogCategoryRepository $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request): RedirectResponse
    {
        $data = $request->post('category');

        $item = new BlogCategory($data);

        if ($item->save()) {
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Saved with success']);
        }

        return back()
            ->withErrors(['msg' => 'Error while saving'])
            ->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View|Application
     */
    public function edit($id): Factory|View|Application
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if (is_null($item)) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, int $id): RedirectResponse
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if (is_null($item)) {
            return back()
                ->withErrors(['msg' => 'No category with id' . $id])
                ->withInput();
        }
        $data = $request->post('category');
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Save with success']);
        }

        return back()
            ->withErrors(['msg' => 'Error while saving'])
            ->withInput();
    }
}
