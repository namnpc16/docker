<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 * @package App\Repositories
 */
class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $_model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    public function getAll(){
        return $this->_model->all();
    }
    public function find($id){
        return $this->_model->find($id);
    }
    public function create(array $attributes){
        return $this->_model->create($attributes);
    }
    public function update($id, array $attributes){
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }
    public function delete($id){
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }
}