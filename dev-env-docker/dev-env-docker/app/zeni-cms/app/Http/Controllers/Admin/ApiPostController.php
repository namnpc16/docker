<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Post,
    RolesPostCate
};
use Illuminate\Support\{
    Str,
    Carbon
};
use App\Http\Requests\{
    RequestFormAddPost,
    RequestFormEditPost
};
use App\Repositories\{
    Post\PostRepository,
    Category\CateRepository,
    Roles\RoleRepository
};
use App\Traits\StorageImageTrait;
use Symfony\Component\HttpFoundation\Response;

class ApiPostController extends Controller
{
    use StorageImageTrait;

    protected $postRepository;
    protected $cateRepository;
    protected $roleRepository;
    public function __construct(PostRepository $postRep, CateRepository $caterepository, RoleRepository $role)
    {
        $this->postRepository = $postRep;
        $this->cateRepository = $caterepository;
        $this->roleRepository = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            
            $post = $this->postRepository->getAll();
            $cate = $this->cateRepository->getAll();
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
                'post' => $post,
                'cate' => $cate
            ], Response::HTTP_OK);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try{
            $dataUploadFile = $this->storageTraitUpload($request, 'img', 'posts');
            //$result = $this->postRepository->insertPost($request->all());
            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'slug' => $request->slug,
                'img' => $dataUploadFile['file_name'],
                'active' => $request->active,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ];
            $result = $this->postRepository->insertPost($data);
            if($result == false){
                $message = "error insert data";
            } else {
                $message = "insert post data success";
            }
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
                'message' => $message,
                'data' => $result,
                'upload file' => $dataUploadFile
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            
            $cate = $this->cateRepository->getAll();
            $post = $this->postRepository->find($id);
            return response()->json([
                'code' => Response::HTTP_OK,
                'post' => $post,
                'cate' => $cate
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            
            if($request->img != "")
            {
                $dataUploadFile = $this->storageTraitUpload($request, 'img', 'posts');
                $filename = $dataUploadFile['file_name'];
                $this->deleteFile($request->idpost); //xoa anh cu di
                $data = [
                    'title' => $request->title,
                    'content' => $request->content,
                    'slug' => $request->slug,
                    'img' => $filename,
                    'active' => $request->active,
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
                ];
            }else{
                $data = [
                    'title' => $request->title,
                    'content' => $request->content,
                    'slug' => $request->slug,
                    'active' => $request->active,
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
                ];
            }
            
            $result = $this->postRepository->updatePost($id, $data);
            if($result == false)
            {
                return response()->json([
                    'status' => true,
                    'code' => 201,
                    'result' => $result,
                    'dataupdate' => $data,
                    'upload file' => $dataUploadFile
                ], 201);
            }else{
                //update category_post 
                $databyid = $this->postRepository->find($request->idpost);
                $databyid->rolesPostCate()->sync($request->cate_id);
                return response()->json([
                    'status' => true,
                    'code' => Response::HTTP_OK,
                    'result' => $result,
                    'dataupdate' => $data,
                    'upload file' => $dataUploadFile
                ], Response::HTTP_OK);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
