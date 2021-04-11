<?php   

namespace App\Repositories; 

class BaseRepository 
{
    protected $model;

    public function _construct(Model $model) {
        $this->model = $model;
    }
}