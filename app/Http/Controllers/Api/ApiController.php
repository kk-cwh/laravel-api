<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Support\ApiResponse;


class ApiController extends Controller
{
	protected $apiResponse;

	// use Helper;

	/**
	 * ApiController constructor.
	 */
	public function __construct()
	{
		$this->apiResponse = new ApiResponse();
	}

}