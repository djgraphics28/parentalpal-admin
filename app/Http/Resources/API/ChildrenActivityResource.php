<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildrenActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->routine_title,
            'date' => $this->date ? $this->date->format('Y-m-d') : null, // Extract only the date
            'time' => $this->date ? $this->date->format('H:i:s') : null, // Extract only the time
            'category' => $this->time_of_day
        ];
    }
}
