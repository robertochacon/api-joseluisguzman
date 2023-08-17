<?php

namespace App\Http\Controllers;

use App\Models\Contents;
use Illuminate\Http\Request;

class ContentsController extends Controller
{

     /**
     * @OA\Get (
     *     path="/api/contents",
     *      operationId="all_contents",
     *     tags={"contents"},
     *     security={{ "apiAuth": {} }},
     *     summary="All contents",
     *     description="All contents",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Name"),
     *              @OA\Property(property="description", type="string", example="Description"),
     *              @OA\Property(property="image", type="string", example="url image"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $contents = Contents::with('category')->get();
        return response()->json(["data"=>$contents],200);
    }

     /**
     * @OA\Get (
     *     path="/api/contents/{id}",
     *     operationId="watch_contents",
     *     tags={"contents"},
     *     security={{ "apiAuth": {} }},
     *     summary="See content",
     *     description="See content",
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Name"),
     *              @OA\Property(property="description", type="string", example="Description"),
     *              @OA\Property(property="image", type="string", example="url image"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function watch($id){
        try{
            $supplier = Contents::find($id);
            return response()->json(["data"=>$supplier],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

         /**
     * @OA\Get (
     *     path="/api/contents/category/{id}",
     *     operationId="watch_contents_category",
     *     tags={"contents"},
     *     security={{ "apiAuth": {} }},
     *     summary="See content by id",
     *     description="See content by id",
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Name"),
     *              @OA\Property(property="description", type="string", example="Description"),
     *              @OA\Property(property="image", type="string", example="url image"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function watchById($id){
        try{
            $supplier = Contents::where('id_category',$id)->get();
            return response()->json(["data"=>$supplier],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/contents",
     *      operationId="store_contents",
     *      tags={"contents"},
     *     security={{ "apiAuth": {} }},
     *      summary="Store content",
     *      description="Store content",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name"},
     *            @OA\Property(property="name", type="string", format="string", example="Name"),
     *            @OA\Property(property="description", type="string", format="string", example="description"),
     *            @OA\Property(property="image", type="string", format="string", example="image"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function register(Request $request)
    {
        $data = request()->all();
        if ($request->hasFile('image')) {
            $uploadFile = $request->file('image');
            $file_name = $uploadFile->hashName();
            $uploadFile->storeAs('public/contents', $file_name);
            $data['image'] = request()->getSchemeAndHttpHost().'/storage/contents/'.$file_name;
        }
        $contents = new Contents($data);
        $contents->save();
        return response()->json(["data"=>$contents],200);
    }

    /**
     * @OA\Put(
     *      path="/api/contents/{id}",
     *      operationId="update_contents",
     *      tags={"contents"},
     *     security={{ "apiAuth": {} }},
     *      summary="Update content",
     *      description="Update content",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name"},
     *            @OA\Property(property="name", type="string", format="string", example="Name"),
     *            @OA\Property(property="description", type="string", format="string", example="description"),
     *            @OA\Property(property="image", type="string", format="string", example="image"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function update(Request $request, $id){
        try{
            $contents = Contents::where('id',$id)->first();
            $contents->update($request->all());
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/contents/{id}",
     *      operationId="delete_contents",
     *      tags={"contents"},
     *     security={{ "apiAuth": {} }},
     *      summary="Delete content",
     *      description="Delete content",
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function delete($id){
        try{
            $contents = Contents::destroy($id);
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

}
