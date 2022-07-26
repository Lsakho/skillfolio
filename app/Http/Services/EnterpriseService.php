<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\Enterprise;


class EnterpriseService {

    public function societe(Request $request, $id = null){
        try{

            $validatorRules = [
                'name' => 'required|string|max:50',
                'address' => 'required|string|max:50',
                'zip' => 'required|string|max:50',
                'city' => 'required|string|max:50',
                'contact_person' => 'required|string|max:50',
                'profile_id' => 'integer|exists:profile,id'
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
        $enterprise = null;

        if($id){
            $enterprise = Enterprise::find($id);
            
            if (!$enterprise){
                throw new ApiException(
                    "Enterprise not found.",
                        404
                    );
                 }
        }
        else{
            $enterprise = new Enterprise();
        }

        if(!$id){
            $enterpriseFound = Enterprise::where('id', $request->input('id'))->first();

            if($enterpriseFound){
                throw new ApiException("Cannot create Enterprise, because a same Enterprise already exists");
            }
            $enterprise->id = $request->input('id');
        }

     
        $enterprise->name = $request->input('name');
        $enterprise->address = $request->input('address');
        $enterprise->zip = $request->input('zip');
        $enterprise->city = $request->input('city');
        $enterprise->contact_person = $request->input('contact_person');
        $entreprise->profile_id = $request->input('profile_id');

        

        $enterprise->save();
        return $enterprise;


        }catch(\Exception $e) {
            throw $e;
        }
    }

  

    public function delete($id) {

        try {

            // Create or update Enterprise.
            $enterprise = Enterprise::find($id);

            // Check if Enterprise.
            if (!$enterprise) {
                throw new ApiException("No Enterprise found");
            }

            // Delete the Enterprise.
            $enterprise->delete();

            

        }catch(\Exception $e){
            throw $e;
        }

    }


    
}