<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Str;
use DateTime;
use Validator;
use App\Http\Requests\RequestFormAddPost;
use App\Http\Requests\RequestFormEditPost;
use Storage;
use App\Traits\StorageImageTrait;

use App\Repositories\Post\PostRepository;

class PostController extends Controller
{
    use StorageImageTrait;

    protected $postRepository;
    public function __construct(PostRepository $postRep)
    {
        $this->postRepository = $postRep;
    }


    // public function test(Type $var = null)
    // {
    //     $this->postRepository->getPostHost();
    // }
    
    public function index(Request $request)
    {
        $arr = [];
        if(isset($request))
        {
            $request->flash();
            $arr['date'] = $request->daySearch;
            $arr['search'] = $request->keysearch;
            $arr['order_by'] = $request->order_by;
            $arr['order_type'] = $request->order_type;
            $arr['limit_record'] = $request->limit_record;
            $result_search = $this->postRepository->searchPost($arr);
            return view('admin.posts.listposts', ['post' => $result_search]);
        }
        $post = $this->postRepository->searchPost($arr);
        return view('admin.posts.listposts' ,['post' => $post]);
    }
    public function addposts(RequestFormAddPost $request)
    {
        $dataUploadFile = $this->storageTraitUpload($request, 'img', 'posts');
        if($request)
        {
            $data = [
                'title' => $request->title,
                'content' => $request->txtarea,
                'slug' => $request->slugtitle,
                'img' => $dataUploadFile['file_name'],
                'active' => $request->active,
                'created_at' => new DateTime()
            ];
            $result = $this->postRepository->insertPost($data);
            if($result == true)
            {
                session()->flash('success', 'Thêm 1 bài viết mới thành công');
            }
            else{
                session()->flash('error', 'Thêm bài viết mới thất bại');
            }
            
            return redirect('/admin/post');
        }
        // $file = $request->file('img')->getClientOriginalName()->store('images');
        // $file = $request->img;
        // $filename = $file->getClientOriginalName();
        // $file->move("images", $filename);
        
    
    }
    public function delData(Request $request)
    {
        if($request)
        {
            $this->postRepository->delete($request->delete_id);
            return redirect()->route('listView.posts');
        }
        return redirect()->route('listView.posts')->with('error','xóa thất bại');

    }
    public function editDataById($id)
    {
        if($id)
        {
            $post = $this->postRepository->find($id);
            return view('admin.posts.editpost', compact('post'));
        }
        
    }
    public function editData(RequestFormEditPost $request) 
    {
        if($request->img)
        {
            $dataUploadFile = $this->storageTraitUpload($request, 'img', 'posts');
            $filename = $dataUploadFile['file_name'];
        }
        else{
            $filename = $request->img_old;
        }
        $data = [
            'title' => $request->title,
            'content' => $request->txtarea,
            'slug' => $request->slugtitle,
            'img' => $filename,
            'active' => $request->active,
            'updated_at' => new DateTime()
        ];
        $result = $this->postRepository->updatePost($request->idpost, $data);
        if($result == false)
        {
            session()->flash('error', 'update bài viết có id: '.$request->idpost.' Thất bại');
        }
        else
        {
            session()->flash('success', 'update bài viết có id: '.$request->idpost.' Thành công'.$request->active);
        }
        return redirect('/admin/post');
    } 
}
