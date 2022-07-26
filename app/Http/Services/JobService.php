<?php


namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\Job;


class JobService {

    public function work(Request $request, $id = null){
        try{

            $validatorRules = [
                'name' => 'required|string|max:75',
                'description' => 'nullable|string|'
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
        $job = null;

        if($id){
            $job = Job::find($id);
            
            if (!$job){
                throw new ApiException(
                    "Job not found.",
                        404
                    );
                 }
        }
        else{
            $job = new Job();
        }

        if(!$id){

            $jobFound = Job::find($id);

            if($jobFound){
                throw new ApiException("Cannot create Job, because a same Job already exists");
            }
            $job->id = $request->input('id');
        }

     
        $job->name = $request->input('name');
        $job->description = $request->input('description');
        

        $job->save();

        return $job;


        }catch(\Exception $e) {
            throw $e;
        }
    }

  

    public function delete($id) {

        try {

            // Create or update Job.
            $job = Job::find($id);

            // Check if Job.
            if (!$job) {
                throw new ApiException("No Job found");
            }

            // Delete the Job.
            $job->delete();

            

        }catch(\Exception $e){
            throw $e;
        }

    }


    
}