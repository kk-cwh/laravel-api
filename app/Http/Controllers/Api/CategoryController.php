<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\CategoryResource;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{


    protected $category;


    public function __construct(Category $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $perPage = request('per_page', 10);
	    $categories = $this->category->when(request('fields', '') == 'select:id|name', function($query) {
		    $query->select('id','name');
	    })->paginate($perPage);
        return $this->apiResponse->paginator($categories, CategoryResource::class);
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
        $this->category->fill($inputs)->save();
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
        $category = $this->category->find($id);
        return $this->apiResponse->item($category, CategoryResource::class);
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
        $updates = $request->only($this->category->getFillable());
        $this->category->where('id', $id)->update($updates);
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
        $this->category->where('id', $id)->update(['status'=>0]);
        return $this->apiResponse->noContent();
    }
}
