<?php

namespace App\Http\Resources;

use App\Models\Training;
use App\Models\Profile;
use Illuminate\Http\Resources\Json\JsonResource;


class SessionResource extends JsonResource
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
            'Training' => Training::find($this->training_id, 'type'),
            'Profile' => Profile::find($this->profile_id, 'firstname'),
            'Date' => rand(2017, 2022),
        ];

    }
}
