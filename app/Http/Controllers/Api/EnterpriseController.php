<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Models\Enterprise;
use App\Http\Resources\EnterpriseResource;
use App\Http\Services\EnterpriseService;
use App\Http\Resources\EnterpriseCollection;

class EnterpriseController extends Controller
{
    public function __construct(private EnterpriseService $_enterpriseservice){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *      path="/enterprises",
     *      operationId="indexEnterprise",
     *      tags={"Enterprises"},
     *      summary="Get list of enterprises",
     *      description="Returns list of enterprise",
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
        $enterprises = Enterprise::all();
        return new EnterpriseCollection($enterprises);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Post(
     *      path="/enterprises",
     *      operationId="storeEnterprise",
     *      tags={"Enterprises"},
     *      summary="Store new Eenterprise",
     *      description="Returns project data",
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="address",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="zip",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="city",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="contact_person",
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
        
            $enterprise = $this->_enterpriseservice->societe($request, null);
            return response([
                'success' => true,
                'message' => 'enterprise created successfully.'
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
     *      path="/enterprises/{id}",
     *      operationId="showEntrepise",
     *      tags={"Enterprises"},
     *      summary="Get Enterprise information",
     *      description="Returns Enterprise data",
     *      @OA\Parameter(
     *          name="id",
     *          description="enterprise_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Enterprise")
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

            $enterprises = Enterprise::where('id', $id)->first();
            if (!$enterprises){
                throw new ApiException(
                    "Enterprise not found.",
                        404
                    );
                 }
            return $enterprises;
        
    
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
     *      path="/enterprises/{id}",
     *      operationId="UpdateEntrepise",
     *      tags={"Enterprises"},
     *      summary="get Enterprise information",
     *      description="Returns Enterprise data",
     *      @OA\Parameter(
     *          name="id",
     *          description="enterprise_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="address",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="zip",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="city",
     *          in="query",
     *          required=true,
     *           @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="contact_person",
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
    public function update(Request $request, $id)
    {
        try {
            $enterprises = $this->_enterpriseservice->societe($request, $id);
            return response([
                'success' => true,
                'message' => 'enterprise updated successfully.'
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
     *      path="/enterprises/{id}",
     *      operationId="deleteEntrepise",
     *      tags={"Enterprises"},
     *      summary="Get Enterprise information",
     *      description="Returns Enterprise data",
     *      @OA\Parameter(
     *          name="id",
     *          description="enterprise_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Enterprise")
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
        $isDeleted = $this->_enterpriseservice->delete($id);
        if(!$isDeleted) {
            return response([
                'success' => true,
                'message' => "Your enterprise has been deleted successfully"
            ], 200);
        } else {
            
            throw new ApiException("No Enterprise found");
        }
    }
}
