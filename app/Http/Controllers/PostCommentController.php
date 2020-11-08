<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationErrorException;
use App\Http\Resources\CommentCollection;
use App\Models\Post;
use Illuminate\Validation\ValidationException;

class PostCommentController extends Controller
{
    public function store(Post $post)
    {
        try {
            $data = request()->validate([
                'body' => 'required',
            ]);
        } catch (ValidationException $e) {
            throw new ValidationErrorException(json_encode($e->errors()));
        }

        $post->comments()->create(array_merge($data, [
            'user_id' => auth()->user()->id,
        ]));

        return new CommentCollection($post->comments);
    }
}
