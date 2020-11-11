<?php
namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{DB, Log};

class UserEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\users::class;
    }
    
    /**
     * GetAllUser
     * @param array $filter
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllUser(array $filter)
    {
        DB::enableQueryLog();
        $order_type = in_array($filter['order_type'], ['desc', 'asc']) ? $filter['order_type'] : 'desc';
        $order_by = isset($filter['order_by']) ? $filter['order_by'] : "id";
        $limit = isset($filter['limit_record']) ? $filter['limit_record'] : 5;
        $search = $filter['search'];
        $date = $filter['date'];

        $data = $this->_model
                ->where(function($query) use($search){
                    $query->orWhere('name', 'like', '%'.$search.'%')
                            ->orWhere('id', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%');
                })
                ->when($date, function($query, $date){
                    return $query->whereDate('created_at', $date);
                })
                ->select('id', 'name', 'email', 'role', 'created_at')
                ->orderby($order_by, $order_type)
                ->paginate($limit);

        $queries = DB::getQueryLog();
        Log::info(compact('queries'));
        return $data;
    }


    /**
     * softDeleteUsers
     * @param array $filter
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function softDeleteUsers(array $filter)
    {
        DB::enableQueryLog();
        $order_type = in_array($filter['order_type'], ['desc', 'asc']) ? $filter['order_type'] : 'desc';
        $order_by = isset($filter['order_by']) ? $filter['order_by'] : "id";
        $limit = isset($filter['limit_record']) ? $filter['limit_record'] : 5;
        $search = $filter['search'];
        $date = $filter['date'];

        $data = $this->_model->onlyTrashed()
                ->where(function ($query) use($search) {
                    $query->orWhere('name', 'like', '%'.$search.'%' )
                            ->orWhere('id', 'like', '%'.$search.'%' );
                })
                ->when($date, function ($query, $date){
                    return $query->whereDate('deleted_at', $date);
                })
                ->select('id', 'name', 'email', 'role', 'deleted_at')
                ->orderby($order_by, $order_type)
                ->paginate($limit);

        $queries = DB::getQueryLog();
        Log::info(compact('queries'));
        return $data;
    }

    /**
     * getAllDelete
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllDelete($id)
    {
        return $this->_model->where('id', $id);
    }

}