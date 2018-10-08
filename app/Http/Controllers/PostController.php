<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostAdd;
use App\Http\Requests\PostEdit;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user', 'tags')->orderBy('created_at', 'desc');
        $posts = $posts->paginate(5);

        return view('posts', ['postInfo' => $posts]);
    }

    public function listUserPosts($userId) {
        $posts = Post::with('user', 'tags')->where('user_id', $userId);
        $posts = $posts->paginate(5);

        return view('posts', ['postInfo' => $posts]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;
        $data['postInfo'] = $post;
        $data['arrTagNames'] = Tag::pluck('name', 'id')->sort();

        return view('postcreate', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostAdd $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $post = new Post;
        $storePostData = $post->insertPostRecord($request);
        if ( $storePostData['status'] ) {
            return redirect('posts')->with('success', $storePostData['message']);
        } 
        return redirect('posts')->with('fail', $storePostData['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $postData = Post::with('user', 'tags')->find($id);
        return view('postdetails', ['postData' => $postData]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['postInfo'] = Post::find($id);
        $data['id'] = $id;
        $data['arrTagNames'] = Tag::pluck('name', 'id')->sort();
        
        return view('postedit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostEdit $request)
    {
        // Retrieve the validated input data...
        // $validated = $request->validated();

        $post = new Post;
        $updatePostData = $post->updatePostRecord($request);

        if( $updatePostData['status'] ) {
            return redirect('posts')->with('success', $updatePostData['message']);
        } 
        return redirect('posts')->with('fail', $updatePostData['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = new Post;
        $destroyPost = $post->deletePostRecord($id);

        if( $destroyPost['status'] ) {
            return redirect('posts')->with('success', $destroyPost['message']);
        }
        return redirect('posts')->with('fail', $destroyPost['message']);
    }
}
