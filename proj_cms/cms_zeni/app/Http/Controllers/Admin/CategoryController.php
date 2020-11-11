<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use DateTime;
use Validator;
use App\Http\Requests\AddToCate;
use App\Http\Requests\RequestFormEditCate;

use App\Repositories\Category\CateRepository;

class CategoryController extends Controller
{
    protected $cateRepository;
    public function __construct(CateRepository $cte)
    {
        $this->cateRepository = $cte;
    }
    
    public function index(Request $request)
    {
        $filter = [];
        if (isset($request)) {
            $request->flash();

            $filter['date'] = $request->daySearch;
            
            $filter['search'] = $request->keysearch;
            $filter['order_by'] = $request->order_by;
            $filter['order_type'] = $request->order_type;
            $filter['limit_record'] = $request->limit_record;
            $result_search = $this->cateRepository->finDataCate($filter);
            return view('admin.category.category_list', ['cate' => $result_search]);
        }

        $cate = $this->cateRepository->finDataCate($filter);
        return view('admin.category.category_list', ['cate' => $cate]);

        // $cate = $this->cateRepository->getAll();
        // return view('admin.category.category_list', compact('cate'));
    }
    public function addcate(AddToCate $request)
    {
        $this->cateRepository->insertData($request->all());
        return redirect()->route('cate.listcate')->with('thongbao', 'Thêm mới danh mục: '.$request->namecate.' thành công ');
    }
    public function deletecate(Request $request)
    {
        if(!empty($request))
        {
            if($this->cateRepository->delete($request->delete_id) == true)
            {
                session()->flash('thongbao', 'Xóa danh mục id = '.$request->delete_id.' thành công');
            }
            else{
                session()->flash('thongbaoloi', 'Xóa thất bại');
            }
            return redirect()->route('cate.listcate');
        }
    }
    public function getdatabyIdeditcate($id)
    {   
        if(!empty($id))
        {
            $cate = $this->cateRepository->find($id);
            return view('admin.category.category_edit', ['cate' => $cate]);
        }
    }
    public function editcate(RequestFormEditCate $request)
    {
        $result = $this->cateRepository->updateData($request->idcate, $request->all());
        if($result == true)
        {
            session()->flash('thongbao', 'Sửa danh mục có id = '.$request->idcate.' Thành công');
        }
        
        return redirect()->route('cate.listcate');
    }
    public function findCate(Request $request)
    {
        // $cate = $this->cateRepository->finDataCate($request->keysearch);
       
        // return view('admin.category.category_list', ['cate' => $cate]);

    }
}
