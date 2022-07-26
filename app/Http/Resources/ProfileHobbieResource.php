<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Hobbie;
use App\Models\Profile;

class ProfileHobbieResource extends JsonResource
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
            'Hobbie' => Hobbie::find($this->hobbie_id, "name"),
            'Profile' => Profile::find($this->profile_id, 'firstname'),
        ];
    }
}
