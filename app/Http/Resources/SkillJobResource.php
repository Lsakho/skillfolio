<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


use App\Models\Job;
use App\Models\Skill;


class SkillJobResource extends JsonResource
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
            'Job' => Job::find($this->job_id, 'name'),
            'Skill' => Skill::find($this->skill_id, 'name'),
        ];
    }
}
