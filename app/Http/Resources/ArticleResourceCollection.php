<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleResourceCollection extends ResourceCollection
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\JsonResponse $response
     */
    public function withResponse($request, $response)
    {
        $query = "&&with=user";
        $jsonResponse = json_decode($response->getContent(), true);
        $data = [
            "first" => $jsonResponse["links"]["first"] . $query,
            "last" => $jsonResponse["links"]["last"] . $query,
            "prev" => empty($jsonResponse["links"]["prev"]) ? null : $jsonResponse["links"]["prev"] . $query,
            "next" => empty($jsonResponse["links"]["next"]) ? null : $jsonResponse["links"]["next"] . $query,
        ];
        $jsonResponse['links'] += ["withuser" => $data];
        $response->setContent(json_encode($jsonResponse));
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
