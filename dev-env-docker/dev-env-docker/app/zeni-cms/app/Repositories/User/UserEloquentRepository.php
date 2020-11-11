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
        return \App\Models\Users::class;
    }
    
    /**
     * GetAllUser
     * @param array $filter
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllUser(array $filter)
    {
        DB::enableQueryLog();
        $search = $filter['table_search'];
        $date = $filter['date'];
        $order_by = $filter['order_by'];
        $order_type = $filter['order_type'];
        $limit = $filter['limit_record'];

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
        $search = $filter['table_search'];
        $date = $filter['date'];
        $order_by = $filter['order_by'];
        $order_type = $filter['order_type'];
        $limit = $filter['limit_record'];

        $data = $this->_model->onlyTrashed()
                ->where(function ($query) use($search) {
                    $query->orWhere('name', 'like', '%'.$search.'%' )
                            ->orWhere('email', 'like', '%'.$search.'%')
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