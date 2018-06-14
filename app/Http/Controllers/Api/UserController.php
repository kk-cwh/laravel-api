<?php
/**
 * Created by PhpStorm.
 * User: ZY
 * Date: 2018/6/13
 * Time: 18:37
 */

namespace App\Http\Controllers\Api;


use App\Http\Resources\UserResource;
use App\User;

class UserController extends ApiController
{
	protected $user;
	public function __construct(User $user)
	{
		parent::__construct();
		$this->user = $user;
	}

	public function index()
	{
		//
		// $user = $this->user->with('roles')->find(1);
		// return $this->apiResponse->item($user, UserResource::class);

		// $users = $this->user->all();
		// return $this->apiResponse->collection($users,UserResource::class);
		//
		$users = $this->user->with('roles')->find(1);
		return $this->apiResponse->json($users,['author-user'=>'zhangyake']);
		//
		// $this->apiResponse->errorBadRequest();
		// $this->apiResponse->noContent();
	}
}