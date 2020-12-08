<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    const POSTS_PER_PAGE = 9;

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

    public function getAllPosts()
    {
        return view('admin.pages.posts', [
            'posts' => Post::all()
        ]);
    }

    public function newPost()
    {
        return view('admin.pages.insert-post');
    }

    public function insertNewPost(Request $request)
    {
        $data = $request->all();
        $data['idUser'] = Auth::id();
        $data['image'] = ImageService::saveImage($request->file('image'), ImageService::IMAGE_TYPE_POST);
        Post::create($data);

        return redirect('/admin/posts');
    }

    public function editPost(int $id)
    {
        $post = Post::find($id);
        return view('admin.pages.update-post', ['post' => $post]);
    }

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

    public function deletePost(int $id)
    {
        Post::where('id', $id)->delete();
        return redirect('/admin/posts');
    }

}
