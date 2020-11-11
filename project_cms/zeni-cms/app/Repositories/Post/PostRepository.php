<?php
namespace App\Repositories\Post;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Carbon;
use App\Models\Posts;
use App\Repositories\BaseRepository;

// extends BaseRepository
class PostRepository extends BaseRepository implements PostInterface
{
    public function __construct(Posts $model)
    {
        parent::__construct($model);
    }
   
    public function insertPost(array $arr)
    {
        if($this->_model->insert($arr))
        {
            return true;
        }
        return false;
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
        $filter['order_by'] = isset($filter['order_by']) ? $filter['order_by'] : "id";
        $filter['order_type'] = in_array($filter['order_type'], ['desc', 'asc']) ? $filter['order_type'] : 'desc';
        $filter['limit_record'] = isset($filter['limit_record']) ? $filter['limit_record'] : 5;

        if(isset($filter['date']))
        {
            $result = $this->_model->where(function ($query) use ($filter) {
                $query->orWhere('id','like','%'.$filter['search'].'%')
                        ->orWhere('title','like','%'.$filter['search'].'%')
                        ->orWhere('slug','like','%$'.$filter['search'].'%')
                        ->orWhere('img','like','%$'.$filter['search'].'%');
                })->whereDate('created_at', $filter['date'])
                    ->orderby($filter['order_by'], $filter['order_type'])
                    ->paginate($filter['limit_record']);
        
        }
        else{
            $result = $this->_model->where('id','like','%'.$filter['search'].'%')
                        ->orWhere('title','like','%'.$filter['search'].'%')
                        ->orWhere('slug','like','%$'.$filter['search'].'%')
                        ->orWhere('img','like','%$'.$filter['search'].'%')
                        ->orderby($filter['order_by'], $filter['order_type'])
                        ->paginate($filter['limit_record']);
        }
        return $result;
    }
    
    
    
}