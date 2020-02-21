<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'username' => $this->name,
            'email' => $this->email,
            'articles' => $this->whenLoaded('articles', function () use($request) {
                return $request->with === 'articles'
                    ?   ArticleResource::collection($this->articles)
                    :   new MissingValue();
            }),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
//    public function with($request)
//    {
//        return [
//            "status" => "ok",
//        ];
//    }
}
