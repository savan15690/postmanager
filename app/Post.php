<?php

namespace App;

use Log;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    /*
        This function is used to insert post record
    */
    public function insertPostRecord($request)
    {
        try {
            $allInputs = $request->all();

            $this->user_id = session('user_id');
            $this->title = $allInputs['title'];
            $this->description = $allInputs['description'];

            if ( $this->save() ) {
                $postId = $this->id;
                $post = $this->find($postId);

                // Attach tags to the post
                $post->tags()->attach($allInputs['tags']);

                return ['status' => 1, 'message' => 'Post created successfully'];
            }
            return ['status' => 0, 'message' => 'Post is not created'];
        } catch (\Exception $e) {
            \Log::error('insertPostRecord - ' . $e->getLine() . '->' . $e->getMessage());
            return ['status' => 0, 'message' => 'insertPostRecord - ' . $e->getLine() . '->' . $e->getMessage()];
        }
    }

    /*
        This function is used to update a post record
    */
    public function updatePostRecord($request)
    {
        try {
            $post = $this->find($request->get('postId'));

            $post->title = $request->get('title');
            $post->description = $request->get('description');

            if ( $post->save() ) {
                // Sync (Update) the tags to the poset
                $post->tags()->sync($request->get('tags'));

                return ['status' => 1, 'message' => 'Post is updated successfully'];
            }
            return ['status' => 0, 'message' => 'Post not updated'];
        } catch (\Exception $e) {
            \Log::error('updatePostRecord - ' . $e->getLine() . '->'. $e->getMessage());
            return ['status' => 0, 'message' => 'updatePostRecord - ' . $e->getLine() . '->'. $e->getMessage()];
        }
    }

    /*
        This function is used to delete a post record
    */
    public function deletePostRecord($postId)
    {
        try {
            $deletePost = $this->where('id', $postId)->delete();

            if ($deletePost) {
                return ['status' => 1, 'message' => 'Post is deleted successfully'];
            }
            return ['status' => 0, 'message' => 'Post not deleted successfully'];
        } catch (\Exceptoin $e) {
            \Log::error('deletePostRecord - ' . $e->getLine(), '->' . $e->getMessage());
            return ['status' => 0, 'message' => 'deletePostRecord - ' . $e->getLine(), '->' . $e->getMessage()];
        }
    }
}