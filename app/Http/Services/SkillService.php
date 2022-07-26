<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\Skill;


class SkillService {

    public function skill(Request $request, $id = null){
        try{

            $validatorRules = [
                'name' => 'nullable|string|max:50',
                'description' => 'nullable|string'
            ];
            
            // Validate fields.
            $validator = Validator::make($request->all(), $validatorRules);
            
            // If validation fails
            // Return error messages and exit.
            if ($validator->fails()) {
                throw (new ValidateException(
                    $validator->errors()
                ));
            }
        $skills = null;

        if($id){
            $skills = Skill::find($id);
            
            if (!$skills){
                throw new ApiException(
                    "Skill not found.",
                        404
                    );
                 }
        }
        else{
            $skills = new Skill();
        }

        if(!$id){
            $skillsFound = Skill::where('id', $request->input('id'))->first();

            if($skillsFound){
                throw new ApiException("Cannot create Skill, because a same Skill already exists");
            }
            $skills->id = $request->input('id');
        }

     
        $skills->name = $request->input('name');
        $skills->description = $request->input('description');
        

        $skills->save();
        return $skills;


        }catch(\Exception $e) {
            throw $e;
        }
    }

  

    public function delete($id) {

        try {

            // Create or update Skill.
            $skills = Skill::find($id);

            // Check if Skill.
            if (!$skills) {
                throw new ApiException("No Skill found");
            }

            // Delete the Skill.
            $skills->delete();

            

        }catch(\Exception $e){
            throw $e;
        }

    }


    
}
