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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
	protected $user;
	public function __construct(User $user)
	{
		parent::__construct();
		$this->user = $user;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$users = $this->user->with('roles')->paginate();
		return $this->apiResponse->paginator($users,UserResource::class);

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
	    $inputs['password'] = Hash::make($inputs['password']);
        $this->user->fill($inputs)->save();
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
        $user = $this->user->find($id);
        return $this->apiResponse->item($user, UserResource::class);
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
        $updates = $request->only($this->user->getFillable());
        $this->user->where('id', $id)->update($updates);
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
        $this->user->where('id', $id)->update(['status'=>0]);
        return $this->apiResponse->noContent();
    }
}
