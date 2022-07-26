<?php

namespace App\Http\Resources;

use App\Models\Skill;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'type' => $this->type,
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'description'=>$this->description,
            'CC' => $this->CC,
            'JC' => $this->JC,
            'trainer' => $this->trainer,
            'status' => $this->status,
        ];
    }
}
