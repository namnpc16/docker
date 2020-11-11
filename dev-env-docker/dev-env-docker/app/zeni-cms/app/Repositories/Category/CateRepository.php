<?php
    namespace App\Repositories\Category;

    //use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;
    use App\Models\Category;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Log;
    use App\Repositories\BaseRepository;

    class CateRepository extends BaseRepository implements CateRepositoryInterface {
        
        public function __construct(Category $cate)
        {
            parent::__construct($cate);
        }
        
        public function insertData($a)
        {
            return $this->_model->insert([
                    'name' => $a['namecate'],
                    'slug' => $a['slugcate'],
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
                ]);
        }
       
        public function updateData($id, array $attributes)
        {
            
            $result = $this->_model->find($id);
            if($result)
            {   
                $this->_model->where('id', $id)->update([
                    'name' => $attributes['namecate'],
                    'slug' => $attributes['slugcate'],
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
                ]);
                return true;
            }
            return false;
        }
        
        public function finDataCate(array $filter)
        {   
            $day = $filter['date'];
            $result = $this->_model->where(function ($query) use ($filter) {
                    $query->orWhere('id','like','%'.$filter['search'].'%')
                          ->orWhere('name','like','%'.$filter['search'].'%')
                          ->orWhere('slug','like','%$'.$filter['search'].'%');
                    })->when($day, function($query, $day){
                        $query->whereDate('created_at', $day);
                    })
                    ->orderby($filter['order_by'], $filter['order_type'])
                      ->paginate($filter['limit_record']);
            
            return $result;
        }
    }

?>