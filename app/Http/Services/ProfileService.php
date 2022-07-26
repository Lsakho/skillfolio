<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Models\Profile;


class ProfileService {

    public function save(request $request, $id = null) {

        try{

            $validatorRules = [

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

            $profile = null;

        // Update

            if($id){
                $profile = Profile::find($id);
                if (!$profile){
                    throw new ApiException(
                        "Profile not found",
                        404
                    );
                }
            }
            else{
                $profile = new Profile();
            }

            $profile->firstname = $request->input('firstname');
            $profile->lastname = $request->input('lastname');
            $profile->description = $request->input('description');
            $profile->type = $request->input('type');
            $profile->CC = $request->input('CC');
            $profile->JC = $request->input('JC');
            $profile->trainer = $request->input('trainer');
            $profile->status = $request->input('status');
            // $profile->skill_id = $request->input('skill_id');

            $profile->save();

        }catch(\Exception $e){
            throw $e;
        }

        
}


public function delete($id) {

    try {

        $profile = Profile::find($id);

        if (!$profile) {
            return response([
                'success' => false,
                'message' => 'Could not find'
            ], 404);
        }

        $profile->delete();
    }catch(\Exception $e){
        throw $e;
    }
}

}