<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CandidatResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CandidatCollection extends ResourceCollection
{

     /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = CandidatResource::class;

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
