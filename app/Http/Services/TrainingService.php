<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\Training;


class TrainingService {

    public function formation(Request $request, $id = null){
        try{

            $validatorRules = [
                'name' => 'required|string|max:50',
                'type' => 'in:Digital,Horlogerie,Logistique,Batiment,Jardinage,Entretient exterieur,Blanchisserie,Nettoyage',
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
        $training = null;

        if($id){
            $training = Training::find($id);
            
            if (!$training){
                throw new ApiException(
                    "Training not found.",
                        404
                    );
                 }
        }
        else{
            $training = new Training();
        }

        if(!$id){
            $trainingFound = Training::where('id', $request->input('id'))->first();

            if($trainingFound){
                throw new ApiException("Cannot create Training, because a same Training already exists");
            }
            $training->id = $request->input('id');
        }

     
        $training->name = $request->input('name');
        $training->type = $request->input('type');
        

        $training->save();
        return $training;


        }catch(\Exception $e) {
            throw $e;
        }
    }

  

    public function delete($id) {

        try {

            // Create or update Training.
            $training = Training::find($id);

            // Check if Training.
            if (!$training) {
                return response([
                    'success' => false,
                    'message' => 'Training not found'
                ], 404);
            }

            // Delete the Training.
            $training->delete();

            

        }catch(\Exception $e){
            throw $e;
        }

    }


    
}