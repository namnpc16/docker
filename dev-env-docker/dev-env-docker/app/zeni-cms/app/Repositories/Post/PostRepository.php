<?php
namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


// extends BaseRepository
class PostRepository extends BaseRepository implements PostInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
   
    public function insertPost(array $arr)
    {
        return $this->_model->create($arr);
    }

    public function updatePost($id, array $arr)
    {
        $result = $this->_model->find($id);
        if($result)
        {
            $this->_model->where('id', $id)->update($arr);
            return true;
        }
        return false;
    }
    
    public function searchPost(array $filter)
    {
        // $filter['order_by'] = isset($filter['order_by']) ? $filter['order_by'] : "id";
        // $filter['order_type'] = in_array($filter['order_type'], ['desc', 'asc']) ? $filter['order_type'] : 'desc';
        // $filter['limit_record'] = isset($filter['limit_record']) ? $filter['limit_record'] : 5;
        $date = $filter['date'];
        $result = $this->_model->where(function ($query) use ($filter) {
                            $query->orWhere('id','like','%'.$filter['search'].'%')
                                ->orWhere('title','like','%'.$filter['search'].'%')
                                ->orWhere('slug','like','%$'.$filter['search'].'%')
                                ->orWhere('img','like','%$'.$filter['search'].'%');
                            })->when($date, function($query, $date){
                                $query->whereDate('created_at', $date);
                            })
                            ->orderby($filter['order_by'], $filter['order_type'])
                            ->paginate($filter['limit_record']);
        
        return $result;
    }
    
    public function gettrash(array $filter)
    {
        $date = $filter['date'];
        $result = $this->_model->onlyTrashed()->where(function ($query) use ($filter) {
                            $query->orWhere('id','like','%'.$filter['search'].'%')
                                ->orWhere('title','like','%'.$filter['search'].'%')
                                ->orWhere('slug','like','%$'.$filter['search'].'%')
                                ->orWhere('img','like','%$'.$filter['search'].'%');
                            })->when($date, function($query, $date){
                                $query->whereDate('deleted_at', $date);
                            })
                            ->orderby($filter['order_by'], $filter['order_type'])
                            ->paginate($filter['limit_record']);
        
        return $result;
    }

    public function restorePost($id)
    {
        return $this->_model->withTrashed()->where('id', $id)->restore();
    }
    
    public function forceDel($id)
    {
        return $this->_model->where('id', $id)->forceDelete();
    }

    
    
    
}