<?php

namespace App\Services;

use App\Models\Faq;

class SharedService
{
    public function go_to($page_path, $compacts /** should be key and value */){
        return view($page_path, $compacts);
    }

    public function get_all($model){    
        return $model::latest()->get();
    }

    public function get_all_pagination($model, $limit){
        return $model::latest()->paginate($limit);
    }

    public function get_by_condition($model, $key, $value){
        return $model::where($key, $value)->latest()->get();
    }

    public function find($model, $id){
        $data = $model::find($id);

        if( !$data ){
            return abort(404);
        }

        if( auth()->user()->id != 1 && $data->created_by != auth()->user()->id ){
            return abort(403) ;
        }

        return $data ;
    }

    public function find_trashed($model, $id){
        $data = $model::onlyTrashed()->find($id);

        if( !$data ){
            return abort(404);
        }

        if( auth()->user()->id != 1 && $data->created_by != auth()->user()->id ){
            return abort(403) ;
        }

        return $data ;
    }

    public function create($model, $data){
        return $model::create($data);
    }

    public function update($model, $id, $data){
        $item = $this->find($model, $id);

        return $item->update($data) ;
    }

    public function delete($model, $id){
        $item = $this->find($model, $id) ;
        return $item->delete();
    }

    public function get_deleted($model){
        return $model::onlyTrashed()->latest()->get();
    }

    public function restore($model, $id, $data){
        $item = $this->find_trashed($model, $id);

        $item->update($data);

        return $item ;
        
    }
}
