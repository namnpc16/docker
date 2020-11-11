<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\{
    Post,
    RolesPostCate
};
use Illuminate\Support\{
    Str,
    Carbon
};
//use DateTime;
// use Validator;
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

class PostController extends Controller
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
    //list
    public function index(Request $request)
    {
        $arr = [];
        $cate = $this->cateRepository->getAll();
        $arr['order_by'] = isset($request->order_by) ? $request->order_by : "id";
        $arr['order_type'] = in_array($request->order_type, ['desc', 'asc']) ? $request->order_type : "desc";
        $arr['limit_record'] = isset($request->limit_record) ? $request->limit_record : 5;
        $request->flash();
        $arr['date'] = $request->daySearch;
        $arr['search'] = $request->keysearch;
        $post = $this->postRepository->searchPost($arr);
        return view('admin.posts.listposts' ,['post' => $post, 'cate'=>$cate]);
    }
    //add view
    public function addView()
    {
        $cate = $this->cateRepository->getAll();
        return view('admin.posts.add_post', compact('cate'));
    }
    //add data
    public function addposts(RequestFormAddPost $request)
    {
        try{
            $dataUploadFile = $this->storageTraitUpload($request, 'img', 'posts');
            $data = [
                'title' => $request->title,
                'content' => $request->txtarea,
                'slug' => $request->slugtitle,
                'img' => $dataUploadFile['file_name'],
                'active' => $request->active,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ];
            $result = $this->postRepository->insertPost($data);
            if($result)
            {
                //add relation to table category_post
                $result->rolesPostCate()->attach($request->cate_id);
                return redirect()->route('listView.posts')->with('success', 'Thêm 1 bài viết mới thành công');
            }
            else{
                return redirect()->route('listView.posts')->with('error', 'Thêm bài viết mới thất bại');
            }
        }
        catch(\Exception $exception){
            Log::error("Error addposts posts".$exception->getMessage());
        }
    }
    //delete
    public function delData(Request $request)
    {
        if($this->postRepository->delete($request->delete_id) == true)
        {
            return redirect()->route('listView.posts')->with('success','Bạn vừa thêm 1 bài viết vào thùng rác');
        }else{
            return redirect()->route('listView.posts')->with('error','xóa thất bại');
        }
    }
    //get data by id
    public function editDataById($id)
    {
        try{
            $cate = $this->cateRepository->getAll();
            $post = $this->postRepository->find($id);
            return view('admin.posts.editpost', compact('post', 'cate'));
        }
        catch(\Exception $exception){
            Log::error("Error editDataById posts".$exception->getMessage());
        }
    }
    //edit data
    public function editData(RequestFormEditPost $request) 
    {
        try{
            if($request->img)
            {
                $dataUploadFile = $this->storageTraitUpload($request, 'img', 'posts');
                $filename = $dataUploadFile['file_name'];
                $this->deleteFile($request->idpost); //xoa anh cu di
            }else{
                $filename = $request->img_old;
            }
            $data = [
                'title' => $request->title,
                'content' => $request->txtarea,
                'slug' => $request->slugtitle,
                'img' => $filename,
                'active' => $request->active,
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ];
            $result = $this->postRepository->updatePost($request->idpost, $data);
            if($result == false)
            {
                return redirect()->route('getlistView.posts')->with('error', 'update bài viết có id: '.$request->idpost.' Thất bại');
            }else{
                //update category_post 
                $databyid = $this->postRepository->find($request->idpost);
                $databyid->rolesPostCate()->sync($request->cate_id);
                return redirect()->route('getlistView.posts')->with('success', 'update bài viết có id: '.$request->idpost.' Thành công');
            }
        }
        catch(\Exception $exception){
            Log::error("Error editData posts".$exception->getMessage());
        }
    } 
    //view trash
    public function showTrash(Request $request)
    {
        $arr = [];
        $cate = $this->cateRepository->getAll();
        $arr['order_by'] = isset($request->order_by) ? $request->order_by : "id";
        $arr['order_type'] = in_array($request->order_type, ['desc', 'asc']) ? $request->order_type : "desc";
        $arr['limit_record'] = isset($request->limit_record) ? $request->limit_record : 5;
        $request->flash();
        $arr['date'] = $request->daySearch;
        $arr['search'] = $request->keysearch;
        $postr = $this->postRepository->gettrash($arr);
        return view('admin.posts.trashposts', ['postr'=>$postr, 'cate'=>$cate]);
    }
    //backup data
    public function restoreTrash($id)
    {
        $ptrash = $this->postRepository->restorePost($id);
        if($ptrash)
        {
            return redirect()->route('trash.posts')->with('success', "Bạn vừa khôi phục lại bài viết có id = ".$id);
        }else{
            return redirect()->route('trash.posts')->with('error', "Khôi phục bài viết thất bại");
        }
    }
    //forcedelete
    public function deleteTrash(Request $request)
    {
        $this->roleRepository->deleteByIdPost($request->delete_id);  //xóa liên kết
        $filename = $this->deleteFile($request->delete_id); // xoa anh
        
        $deltrash = $this->postRepository->forceDel($request->delete_id); //delete post
        if($deltrash)
        {
            return redirect()->route('trash.posts')->with('success', "Bạn vừa xóa bài viết có id = ".$request->delete_id);
        }else{
            return redirect()->route('trash.posts')->with('error', "Xóa thất bại");
        }    
    }

}
