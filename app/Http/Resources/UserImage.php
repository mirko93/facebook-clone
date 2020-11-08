<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserImage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'user-images',
                'user_image_id' => $this->id,
                'attributes' => [
                    'path' => url($this->path),
                    'width' => $this->path,
                    'height' => $this->path,
                    'location' => $this->path,
                ]
            ],
            'links' => [
                'self' => url('/users/'.$this->user_id),
            ]
        ];
    }
}
