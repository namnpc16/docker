<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use Illuminate\Support\Str;
//use DateTime;
//use Validator;
use App\Http\Requests\{
    AddToCate,
    RequestFormEditCate
};
use App\Repositories\{
    Category\CateRepository,
    Roles\RoleRepository
};

class CategoryController extends Controller
{
    protected $cateRepository;
    protected $roleRepository;
    
    public function __construct(CateRepository $cte, RoleRepository $role)
    {
        $this->cateRepository = $cte;
        $this->roleRepository = $role;
    }
    
    public function index(Request $request)
    {
        $arr = [];
        $request->flash();
        $arr['order_by'] = isset($request->order_by) ? $request->order_by : "id";
        $arr['order_type'] = in_array($request->order_type, ['desc', 'asc']) ? $request->order_type : "desc";
        $arr['limit_record'] = isset($request->limit_record) ? $request->limit_record : 5;
        $arr['date'] = $request->daySearch;
        $arr['search'] = $request->keysearch;
        $cate = $this->cateRepository->finDataCate($arr);
        return view('admin.category.category_list', ['cate' => $cate]);
    }
    //add data
    public function addcate(AddToCate $request)
    {
        try{
            $this->cateRepository->insertData($request->all());
            return redirect()->route('cate.listcate')->with('thongbao', 'Thêm mới danh mục: '.$request->namecate.' thành công ');
        }
        catch(\Exception $exception){
            Log::error("Error addcate category ".$exception->getMessage());
        }
    }
    //delete data
    public function deletecate(Request $request)
    {
        if(!$request->delete_id)
        {
            return redirect()->route('cate.listcate')->with('thongbaoloi', 'Xóa thất bại');
        }
        else{
            $this->roleRepository->deleteRoleByIdCate($request->delete_id);
            $this->cateRepository->delete($request->delete_id);
            return redirect()->route('cate.listcate')->with('thongbao', 'Xóa danh mục id = '.$request->delete_id.' thành công');
        }
    }
    //get data by id
    public function getdatabyIdeditcate($id)
    {   
        if(!$id)
        {
            return redirect()->route('cate.listcate')->with('thongbaoloi', 'id không xác định');
        }
        else{
            $cate = $this->cateRepository->find($id);
            return view('admin.category.category_edit', ['cate' => $cate]);
        }
    }
    //edit data
    public function editcate(RequestFormEditCate $request)
    {
        $result = $this->cateRepository->updateData($request->idcate, $request->all());
        if($result == true)
        {
            return redirect()->route('cate.listcate')->with('thongbao', 'Sửa danh mục có id = '.$request->idcate.' Thành công');
        }
        else{
            return redirect()->route('cate.listcate')->with('thongbaoloi', 'Sửa danh mục có id = '.$request->idcate.' thất bại');
        }
    }

}
