<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\Friend as FriendResource;
use App\Exceptions\FriendRequestNotFoundException;
use App\Exceptions\ValidationErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FriendRequestResponseController extends Controller
{
    public function store() 
    {
        try {
            $data = request()->validate([
                'user_id' => 'required',
                'status' => 'required',
            ]);
        } catch (ValidationException $e) {
            throw new ValidationErrorException(json_encode($e->errors()));
        }

        try {
            $friendRequest = Friend::where('user_id', $data['user_id'])
            ->where('friend_id', auth()->user()->id)
            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new FriendRequestNotFoundException();
        }

        $friendRequest->update(array_merge($data, [
            'confirmed_at' => now(),
        ]));

        return new FriendResource($friendRequest);
    }

    public function destroy()
    {
        try {
            $data = request()->validate([
                'user_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            throw new ValidationErrorException(json_encode($e->errors()));
        }

        try {
            Friend::where('user_id', $data['user_id'])
            ->where('friend_id', auth()->user()->id)
            ->firstOrFail()
            ->delete();
        } catch (ModelNotFoundException $e) {
            throw new FriendRequestNotFoundException();
        }

        return response()->json([], 204);
    }
}
