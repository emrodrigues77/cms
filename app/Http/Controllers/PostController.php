<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class PostController extends Controller {

    public function index() {
        $posts = auth()->user()->posts()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function show(Post $post) {
        return view('blog-post', compact('post'));
    }

    public function create() {
        //$this->authorize('create');
        return view('admin.posts.create');
    }

    public function store() {
        //$this->authorize('create', Post::class);
        $inputs = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'post_image' => 'file',
        ]);

        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);
        request()->session()->flash('post-created-message', 'Post was created');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post, Request $request) {
        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('post-deleted-message', 'Post was deleted');
        return redirect()->route('post.index');
    }

    public function edit(Post $post) {
        $this->authorize('view', $post);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Post $post) {
        $this->authorize('update', $post);

        $inputs = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'post_image' => 'file',
        ]);

        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->update();

        request()->session()->flash('post-updated-message', 'Post was updated');
        return redirect()->route('post.index');
    }
}