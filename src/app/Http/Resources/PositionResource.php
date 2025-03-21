<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'position',
            'id' => $this->id,
            'attributes' => [
                'slug' => $this->slug,
                'title' => $this->title,
                'description' => $this->description,
                'location' => $this->location,
                'openedAt' => $this->opened_at,
                'closedAt' => $this->closed_at,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'relationships' => [
                'company' => [
                    'data' => [
                        'type' => 'company',
                        'id' => $this->company_id,
                    ],
                ],
            ],
        ];
    }
}
