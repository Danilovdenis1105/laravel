<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Str;

class  PostController extends BaseController
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (is_null($item)) {
            return back()
                ->withErrors(['msg' => 'No post with id '.$id])
                ->withInput();
        }

        $data = $request->post('post');
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if (empty($item->published_at) && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
