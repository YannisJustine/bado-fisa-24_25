<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CreneauxResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CreneauCollection extends ResourceCollection
{
   
     /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = CreneauResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
