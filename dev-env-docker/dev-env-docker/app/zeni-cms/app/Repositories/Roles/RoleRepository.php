<?php
    namespace App\Repositories\Roles;

    //use Illuminate\Database\Eloquent\Model;
    use App\Models\RolesPostCate;
    use DateTime;
    use Illuminate\Support\Facades\Log;
    use App\Repositories\BaseRepository;

    class RoleRepository extends BaseRepository implements RoleInterface {
        
        public function __construct(RolesPostCate $role)
        {
            parent::__construct($role);
        }

        public function findRole(array $filter)
        {   
            
        }

        public function deleteRoleByIdCate($id)
        {
            $this->_model->where('category_id', $id)->delete();
        }
        public function deleteByIdPost($id)
        {
            $this->_model->where('post_id', $id)->delete();
        }
        
    }

?>