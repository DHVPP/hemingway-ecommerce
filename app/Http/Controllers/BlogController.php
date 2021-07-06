<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{
    /**
     * How much blog posts are on one page
     */
    const POSTS_PER_PAGE = 9;

    /**
     * @param int $id
     */
    public function show(int $id)
    {
        $post = Post::find($id);

        return view('pages.blog.post-page', [
            'post' => $post
        ]);
    }

    /**
     * @param Post $model
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllPosts(Post $model, Request $request)
    {
        $count = $model->count();
        $model = $this->paginateQuery($model, $request);
        return view('pages.blog.blog-list', [
            'chunks' => !empty($model) ? $model->chunk(3) : collect([]),
            'count' => ceil($count / self::POSTS_PER_PAGE)
        ]);
    }

    /**
     * @param $model
     * @param Request $request
     * @return iterable|null
     */
    protected function paginateQuery($model, Request $request): ?iterable
    {
        if ($request->has('page') && $request->get('page') > 1) {
            $model->skip(self::POSTS_PER_PAGE * ((int)$request->get('page') - 1));
        }
        return $model->take(self::POSTS_PER_PAGE)->get();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllPosts()
    {
        return view('admin.pages.posts', [
            'posts' => Post::all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newPost()
    {
        return view('admin.pages.insert-post');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insertNewPost(Request $request)
    {
        $data = $request->all();
        $data['idUser'] = Auth::id();
        $data['image'] = ImageService::saveImage($request->file('image'), ImageService::IMAGE_TYPE_POST);
        Post::create($data);

        return redirect('/admin/posts');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPost(int $id)
    {
        $post = Post::find($id);
        return view('admin.pages.update-post', ['post' => $post]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePost(Request $request, int $id)
    {
        $post = Post::find($id);
        $data = $request->all();

        if (!empty($data['image'])) {
            $data['image'] = ImageService::saveImage($request->file('image'), ImageService::IMAGE_TYPE_POST);
        }

        $post->fill($data);
        $post->save();

        return redirect('/admin/posts');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deletePost(int $id)
    {
        Post::where('id', $id)->delete();
        return redirect('/admin/posts');
    }

}
