<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildrenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Create a DateTime object from the birth_date
        $birthDate = new \DateTime($this->birth_date);
        // Get the current date
        $currentDate = new \DateTime();
        // Calculate the difference
        $age = $currentDate->diff($birthDate);

        return [
            'name' => $this->name,
            'gender' => $this->gender,
            'age' => $age->y . ' years and ' . $age->m . ' months', // Format the age
        ];
    }
}
