<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;
use App\Models\Skill;
use App\Models\ProfileSkill;
use App\Http\Resources\SkillResource;
use App\Http\Resources\SkillCollection;
use App\Http\Services\SkillService;
use App\Http\Resources\ProfileSkillCollection;
use App\Http\Resources\ProfileSkillResource;



class SkillController extends Controller
{
    public function __construct(private SkillService $_skillservice){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/skills",
     *   tags={"Skills"},
     *   summary="Get skills",
     *   operationId="index skills",
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
        $skills = Skill::all();
        return new SkillCollection($skills);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *      path="/skills",
     *      operationId="store skills",
     *      tags={"Skills"},
     *      summary="Store new skill",
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
        
            $skills = $this->_skillservice->skill($request, null);
            return response([
                'success' => true,
                'message' => 'Skill created successfully.'
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
     *      path="/skills/{id}",
     *      operationId="show skills",
     *      tags={"Skills"},
     *      summary="Get Skills information",
     *      description="Returns Skills data",
     *      @OA\Parameter(
     *          name="id",
     *          description="skill_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Skill")
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

            $skills = Skill::where('id', $id)->first();
            if (!$skills){
                throw new ApiException(
                    "Skill not found.",
                        404
                    );
                 }
            return $skills;
        
    
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
     *      path="/skills/{id}",
     *      operationId="update skills",
     *      tags={"Skills"},
     *      summary="Get Skill information",
     *      description="Returns Skill data",
     *      @OA\Parameter(
     *          name="id",
     *          description="skill_id",
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
     *          @OA\PathItem(ref="#/components/schemas/Skill")
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
            $skills = $this->_skillservice->skill($request, $id);
            return response([
                'success' => true,
                'message' => 'Skill updated successfully.'
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
     *      path="/skills/{id}",
     *      operationId="delete skills",
     *      tags={"Skills"},
     *      summary="Get Skill information",
     *      description="Returns Skill data",
     *      @OA\Parameter(
     *          name="id",
     *          description="skill_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\PathItem(ref="#/components/schemas/Skill")
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
    public function destroy($id)
    {
        $isDeleted = $this->_skillservice->delete($id);
        if(!$isDeleted) {
            return response([
                'success' => true,
                'message' => "Your skill has been deleted successfully"
            ], 200);
        } else {
        throw new ApiException("Cannot delete skill.");
        }

    }

    public function profileskill()
    {
        $profileskill = ProfileSkill::all();
        return new ProfileSkillCollection($profileskill);
    }
}
