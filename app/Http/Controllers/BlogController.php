<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
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
