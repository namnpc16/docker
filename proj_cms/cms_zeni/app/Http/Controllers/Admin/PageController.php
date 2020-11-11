<?php

namespace App\Http\Controllers\Admin;

use App\ {
    Http\Controllers\Controller,
    Http\Requests\CreatePageRequest,
    Http\Requests\EditPageRequest,
    Repositories\Page\PageEloquentRepository
};
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pageRepository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Page\PageEloquentRepository $pageRepository
     * @return void
     */
    public function __construct(PageEloquentRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * dump data out view
     * 
     * @param \App\Http\Requests $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->flash();
        $filter['table_search'] = $request->input('table_search', '');
        $filter['order_by'] = $request->input('order_by', 'id');
        $filter['order_type'] = $request->input('order_type', 'desc');
        $filter['limit_record'] = $request->input('limit_record', 5);
        $filter['date'] = $request->date;
        $pages = $this->pageRepository->getAllPage($filter);
        
        return view('admin.page.listpage', ['pages' => $pages]);
    }

    /**
     * show form create page
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.page.createpage');
    }

    /**
     * create data into the database
     * 
     * @param \App\Http\Requests\CreatePageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePageRequest $request)
    {
        $data = $request->all();
        $this->pageRepository->create($data);
        return redirect()->route('list.page')->with('success', 'Thêm mới Page thành công !');
    }

    /**
     * show form edit page 
     * 
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $page = $this->pageRepository->find($id);
        return view('admin.page.editpage', ['page' => $page]);
    }

    /**
     * update data into the database
     * 
     * @param \App\Http\Requests\EditPageRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditPageRequest $request, $id)
    {
        $this->pageRepository->update($id, $request->all());
        return redirect()->route('list.page')->with('success', 'Chỉnh sửa Page thành công !');
    }

    /**
     * delete page
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $this->pageRepository->delete($request->delete_id);
        return redirect()->route('list.page')->with('success', 'Xóa Page thành công !');
    }
}
