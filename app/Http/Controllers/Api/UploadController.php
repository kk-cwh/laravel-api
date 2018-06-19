<?php

namespace App\Http\Controllers\Api;



use Illuminate\Http\Request;

class UploadController extends ApiController
{





    public function __construct( )
    {
        parent::__construct();

    }
	public function fileUpload(Request $request)
	{
		$strategy = $request->get('strategy', 'images');

		if (!$request->hasFile('file')) {
			return $this->apiResponse->json([
				'success' => false,
				'error' => 'no file found.',
			]);
		}
		$file=$request->file('file');
		$path = $strategy . '/' . date('Y') . '/' . date('m') . '/' . date('d');

		$result = $file->store($path,'public');

		return $this->apiResponse->json('http://laravel.api.lara/storage/'.$result);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
