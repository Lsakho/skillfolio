<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Profile;
use App\Models\Skill;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Profile' => Profile::find($this->profile_id, ['type', 'firstname']),
            'Skill' => Skill::find($this->skill_id, 'name'),
            'nb_stars' => rand(1, 5)
        ];
    }
}
