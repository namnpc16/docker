<?php
namespace App\Repositories\Roles;

use App\Repositories\RepositoryInterface;

interface RoleInterface extends RepositoryInterface
{
    public function findRole(array $filter);
    public function deleteRoleByIdCate($id);
    public function deleteByIdPost($id);
}