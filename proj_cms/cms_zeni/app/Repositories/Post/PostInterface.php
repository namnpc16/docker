<?php
namespace App\Repositories\Post;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;

interface PostInterface extends RepositoryInterface
{
    public function insertPost(array $arr);
    public function updatePost($id, array $arr);
    public function searchPost(array $filter);
}