<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hobbie;
use App\Models\ProfileHobbie;
use App\Http\Resources\HobbieCollection;
use App\Http\Resources\ProfileHobbieCollection;
use App\Http\Services\HobbieService;
use App\Http\Resources\HobbieResource;
use App\Http\Resources\ProfileHobbieResource;



class HobbieController extends Controller
{

    public function __construct(private HobbieService $_hobbieservice){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     ** path="/hobbies",
     *   tags={"Hobbies"},
     *   summary="Get all hobbies",
     *   operationId="index hobbies",
     *
     *   
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function index()
    {
        $hobbies = Hobbie::all();

        return new HobbieCollection($hobbies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        /**
     * @OA\Post(
     *      path="/hobbies",
     *      operationId="store hobbie",
     *      tags={"Hobbies"},
     *      summary="Store new hobbies",
     *      description="Returns project data",
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     * @OA\Parameter(
     *          name="description",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
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
     * )
     */
    public function store(Request $request)
    {
        try {

            $hobbies = $this->_hobbieservice->administratif($request, null);
            return response([
                'success' => true,
                'message' => 'Hobby added successfully.'
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
     *      path="/hobbies/{id}",
     *      operationId="show hobbies",
     *      tags={"Hobbies"},
     *      summary="Get Hobbie information",
     *      description="Returns Hobbie data",
     *      @OA\Parameter(
     *          name="id",
     *          description="hobbie_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Hobbie")
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

            $hobbie = Hobbie::find($id);
            if(!$hobbie){
                return response([
                    'success' => false,
                    'message' => 'Hobbie not found.'
                ], 404);
            }

            return ['data'=> $hobbie];

        } catch (\Exception $e) {
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
     *      path="/hobbies/{id}",
     *      operationId="update hobbies",
     *      tags={"Hobbies"},
     *      summary="Get Hobbie information",
     *      description="Returns Hobbie data",
     *      @OA\Parameter(
     *          name="id",
     *          description="hobbie_id",
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
     *          @OA\PathItem(ref="#/components/schemas/Hobbie")
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
        try{

            $hobbies = $this->_hobbieservice->administratif($request, $id);
            return response([
                'success' => true,
                'message' => 'hobbie updated successfully'
            ], 200);

        }catch(\Exception $e){
            throw $e;
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
     *      path="/hobbies/{id}",
     *      operationId="delete hobbies",
     *      tags={"Hobbies"},
     *      summary="Get Hobbie information",
     *      description="Returns Hobbie data",
     *      @OA\Parameter(
     *          name="id",
     *          description="hobbie_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Hobbie")
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
        try{
            $isDeleted = $this->_hobbieservice->delete($id);
            if(!$isDeleted){
                return response([
                    'success' => true,
                    'message' => 'Your hobbie successfully deleted'
                ],200);
            } else {
                return response([
                    'success' => false,
                    'message' => 'Hobbie not found'
                ], 404);
            }

        }catch(\Exception $e){
            throw $e;
        }
    }

         /**
     * @OA\Get(
     *      path="/profilehobbies",
     *      operationId="index profilehobbie",
     *      tags={"profile-hobbie"},
     *      summary="Get list of profilehobbie",
     *      description="Returns list of profilehobbie",
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

    public function ProfileHobbie()
    {
        $profilehobbie = ProfileHobbie::all();

        return new ProfileHobbieCollection($profilehobbie);
    }
}
