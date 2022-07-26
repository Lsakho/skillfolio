<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\Hobbie;


class HobbieService {

    public function administratif(Request $request, $id = null){
        try{

            $validatorRules = [
                'name' => 'required|string|max:50',
                'description' => 'required|string|max:50',
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
        $hobbie = null;

        if($id){
            $hobbie = Hobbie::find($id);
            
            if (!$hobbie){
                throw new ApiException(
                    "Hobbie not found.",
                        404
                    );
                 }
        }
        else{
            $hobbie = new Hobbie();
        }

        if(!$id){
            $hobbieFound = Hobbie::where('id', $request->input('id'))->first();

            if($hobbieFound){
                throw new ApiException("Cannot create Hobbie, because a same Hobbie already exists");
            }
            $hobbie->id = $request->input('id');
        }

     
        $hobbie->name = $request->input('name');
        $hobbie->description = $request->input('description');
        

        

        $hobbie->save();
        return $hobbie;


        }catch(\Exception $e) {
            throw $e;
        }
    }

  

    public function delete($id) {

        try {

            // Create or update hobbie.
            $hobbie = Hobbie::find($id);

            // Check if Hobbie.
            if (!$hobbie) {
                throw new ApiException("No Hobbie found");
            }

            // Delete the Hobbie.
            $hobbie->delete();

            

        }catch(\Exception $e){
            throw $e;
        }

    }


    
}