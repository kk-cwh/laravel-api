<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\RoleResource;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends ApiController
{


    protected $role;


    public function __construct(Role $role)
    {
        parent::__construct();
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->paginate();
        return $this->apiResponse->paginator($roles, RoleResource::class);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $this->role->fill($inputs)->save();
        return $this->apiResponse->created();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role->find($id);
        return $this->apiResponse->item($role, RoleResource::class);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updates = $request->only($this->role->getFillable());
        $this->role->where('id', $id)->update($updates);
        return $this->apiResponse->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->role->where('id', $id)->update(['status'=>0]);
        return $this->apiResponse->noContent();
    }
}
