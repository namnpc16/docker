<?php
    namespace App\Repositories\Category;

    //use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;
    use App\Models\Category;
    use DateTime;
    use Illuminate\Support\Facades\Log;
    use App\Repositories\BaseRepository;

    class CateRepository extends BaseRepository implements CateRepositoryInterface {
        
        public function __construct(Category $cate)
        {
            parent::__construct($cate);
        }
        
        public function insertData($a)
        {
            if(!empty($a))
            {
                $this->_model->insert([
                    'name' => $a['namecate'],
                    'slug' => $a['slugcate'],
                    'created_at' => new DateTime()
                ]);
            }
            
        }
       
        public function updateData($id, array $attributes)
        {
            
            $result = $this->_model->find($id);
            if($result)
            {   
                $this->_model->where('id', $id)->update([
                    'name' => $attributes['namecate'],
                    'slug' => $attributes['slugcate'],
                    'updated_at' => new DateTime()
                ]);
                return true;
            }
            return false;
        }
        
        public function finDataCate(array $filter)
        {   
            $filter['order_by'] = isset($filter['order_by']) ? $filter['order_by'] : "id";
            $filter['order_type'] = in_array($filter['order_type'], ['desc', 'asc']) ? $filter['order_type'] : 'desc';
            $filter['limit_record'] = isset($filter['limit_record']) ? $filter['limit_record'] : 5;

            if(isset($filter['date']))
            {
                $result = $this->_model->where(function ($query) use ($filter) {
                    $query->orWhere('id','like','%'.$filter['search'].'%')
                          ->orWhere('name','like','%'.$filter['search'].'%')
                          ->orWhere('slug','like','%$'.$filter['search'].'%');
                    })->whereDate('created_at', $filter['date'])
                      ->orderby($filter['order_by'], $filter['order_type'])
                      ->paginate($filter['limit_record']);
               
            }
            else{
                $result = $this->_model->where('id','like','%'.$filter['search'].'%')
                          ->orWhere('name','like','%'.$filter['search'].'%')
                          ->orWhere('slug','like','%$'.$filter['search'].'%')
                          ->orderby($filter['order_by'], $filter['order_type'])
                          ->paginate($filter['limit_record']);
            }
            return $result;
        }
    }

?>