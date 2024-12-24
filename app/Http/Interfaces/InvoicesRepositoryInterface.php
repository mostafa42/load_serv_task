<?php

namespace App\Http\Interfaces;

interface InvoicesRepositoryInterface
{
    public function index();
    public function store($request);
    public function update($id, $request) ;
    public function delete($id) ;
}
