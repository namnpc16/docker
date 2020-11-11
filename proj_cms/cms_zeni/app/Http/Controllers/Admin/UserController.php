<?php

namespace App\Http\Controllers\Admin;

use App\ {
    Http\Controllers\Controller,
    Http\Requests\CreateUserRequest,
    Http\Requests\EditUserRequest,
    Repositories\User\UserEloquentRepository
};
use Illuminate\ {
    Http\Request,
    Support\Str,
};

class UserController extends Controller
{
    protected $userRepository;

     /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\User\UserEloquentRepository $userRepository
     * @return void
     */
    public function __construct(UserEloquentRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * dump all data out view
     * 
     * @param \Illuminate\Http\Request $request
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
        
        $users = $this->userRepository->getAllUser($filter);
        
        return view('admin.user.listuser', ['users' => $users]);
    }

    /**
     * show form create user
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.createuser');
    }

    /**
     * create data into the database
     * 
     * @param \App\Http\Requests\CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->all();
       
        $this->userRepository->create($data);

        return redirect()->route('list.user')->with('success', __('user.controller.store'));
    }

    /**
     * show form edit user
     * 
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return view('admin.user.edituser', ['user' => $user]);
    }

    /**
     * update data into the database
     * 
     * @param int $id
     * @param \App\Http\Requests\EditUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditUserRequest $request, $id)
    {
        $data = $request->all();
    
        if ($request->password) {
            $data['password'] = $request->password;
        }else{
            $data = $request->except('password');
        }
        
        $this->userRepository->update($id, $data);
 
        return redirect()->route('list.user')->with('success', __('user.controller.update'));
    }

    /**
     * soft delete user
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $id = $request->delete_id;
        $this->userRepository->delete($id);

        return redirect()->route('list.user')->with('success', __('user.controller.softDelete'));
    }

    /**
     * show form soft delete 
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function soft(Request $request)
    {
        $request->flash();
        $filter['table_search'] = $request->input('table_search', '');
        $filter['order_by'] = $request->input('order_by', 'id');
        $filter['order_type'] = $request->input('order_type', 'desc');
        $filter['limit_record'] = $request->input('limit_record', 5);
        $filter['date'] = $request->date;

        $trashUser = $this->userRepository->softDeleteUsers($filter);
       
        return view('admin.user.softdeleteuser', ['trashUser' => $trashUser]);
    }

    /**
     * restore user and delete user
     * 
     * @param \Illuminate\Http\Request $request
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request)
    {
        if ($request->restore_id) {

            $id = $request->restore_id;

            $this->userRepository->getAllDelete($id)->restore();

            return redirect()->route('soft.user')->with('success', __('user.controller.restore'));
        }elseif ($request->delete_id) {

            $id = $request->delete_id;

            $this->userRepository->getAllDelete($id)->forceDelete();

            return redirect()->route('soft.user')->with('success', __('user.controller.delete'));
        }else{
            return false;
        }
    }
}
