<?php
    namespace App\Repositories\Category;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Category;
    use App\Repositories\RepositoryInterface;
    
    interface CateRepositoryInterface extends RepositoryInterface {
        public function getAll();
        public function insertData($arr);
        
        public function updateData($id, array $attributes);
        
        public function finDataCate(array $filter);
    }

?>