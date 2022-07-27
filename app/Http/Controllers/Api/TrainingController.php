<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Models\Training;
use App\Models\Profile;
use App\Models\Session;
use App\Http\Resources\TrainingResource;
use App\Http\Services\TrainingService;
use App\Http\Resources\TrainingCollection;
use App\Http\Resources\SessionResource;
use App\Http\Resources\SessionCollection;




class TrainingController extends Controller
{
    public function __construct(private TrainingService $_trainingservice){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Get(
     *      path="/trainings",
     *      operationId="index",
     *      tags={"Trainings"},
     *      summary="Get list of trainings",
     *      description="Returns list of trainings",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\PathItem
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        $trainings = Training::all();
        return new TrainingCollection($trainings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *      path="/trainings",
     *      operationId="store",
     *      tags={"Trainings"},
     *      summary="Store new training",
     *      description="Returns project data",
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name= "type",         
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string",
     *          enum={"Digital","Horlogerie","Logistique","Batiment","Jardinage","Entretient exterieur","Blanchisserie","Nettoyage"}
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *           @OA\PathItem
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function store(Request $request)
    {
        try {
        
            $training = $this->_trainingservice->formation($request, null);
            return response([
                'success' => true,
                'message' => 'Training created successfully.'
            ], 200);
    
        }catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *      path="/trainings/{id}",
     *      operationId="show",
     *      tags={"Trainings"},
     *      summary="Get Training information",
     *      description="Returns Training data",
     *      @OA\Parameter(
     *          name="id",
     *          description="training_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Training")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        try {

            $trainings = Training::where('id', $id)->first();
            if (!$trainings){
                throw new ApiException(
                    "Training not found.",
                        404
                    );
                 }
            return $trainings;
        
    
        }catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

          /**
     * @OA\Put(
     *      path="/trainings/{id}",
     *      operationId="update",
     *      tags={"Trainings"},
     *      summary="Get Training information",
     *      description="Returns Training data",
     *      @OA\Parameter(
     *          name="id",
     *          description="training_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Training")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $trainings = $this->_trainingservice->formation($request, $id);
            return response([
                'success' => true,
                'message' => 'Training updated successfully.'
            ], 200);
        } catch (\Exception $e) {
            throw ($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *      path="/trainings/{id}",
     *      operationId="delete",
     *      tags={"Trainings"},
     *      summary="Get Training information",
     *      description="Returns Training data",
     *      @OA\Parameter(
     *          name="id",
     *          description="training_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Training")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function delete($id)
    {
        $isDeleted = $this->_trainingservice->delete($id);
        if(!$isDeleted) {
            return response([
                'success' => true,
                'message' => "Your training has been deleted successfully"
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'Training not found'
            ], 404);
        }

    }

     /**
     * @OA\Get(
     *      path="/sessions",
     *      operationId="indexSessions",
     *      tags={"Sessions"},
     *      summary="Get list of sessions",
     *      description="Returns list of Sessions",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\PathItem
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function sessions()
    {
        $sessions = Session::all();
        return new SessionCollection($sessions);
    }
}
