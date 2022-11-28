<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends BaseController
{
    private BlogPostRepository $blogPostRepository;

    private BlogCategoryRepository $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): Factory|View|Application
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate(25);

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * @param BlogPostCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogPostCreateRequest $request): RedirectResponse
    {
        $data = $request->post('post');

        $item = BlogPost::create($data);

        if ($item) {
            return redirect()
                ->route('blog.admin.posts.edit', [$item->id])
                ->with(['success' => 'Saved with success']);
        }

        return back()
            ->withErrors(['msg' => 'Error while saving'])
            ->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $item = $this->blogPostRepository->getEdit($id);
        if (is_null($item)) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogPostUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogPostUpdateRequest $request, int $id): RedirectResponse
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (is_null($item)) {
            return back()
                ->withErrors(['msg' => 'No post with id ' . $id])
                ->withInput();
        }

        $data = $request->post('post');

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Save with success']);
        }

        return back()
            ->withErrors(['msg' => 'Error while saving'])
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $result = BlogPost::destroy($id);

        if ($result) {
            return redirect()->route('blog.admin.posts.index')
                ->with(['sussess' => "Post was delete with id: { $id }"]);
        }

        return back()->withErrors(['msg' => 'Error while deleting']);
    }
}
