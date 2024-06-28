<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
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
            'user_id' => $this->user_id,
            'field_id' => $this->field_id,
            'feedback_text' => $this->feedback_text,
            'user' => optional($this->users)->name,
            'field' => optional($this->field)->field_name,
        ];
    }
}
