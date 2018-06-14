<?php
namespace App\Http\Controllers\Api;




use App\Http\Resources\UserResource;

class JwtAuthController extends ApiController
{
	/**
	 * Create a new JwtAuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		//  放到路由文件 api.php中 此处不在需要
		// $this->middleware('auth:api', ['except' => ['login']]);
	}

	/**
	 * Get a JWT via given credentials.
	 * 用户登录
	 * @return \Illuminate\Http\Response
	 */
	public function login()
	{
		$credentials = request(['name','password']);
		// $credentials['status'] = 1 ; 用户启用
		if (! $token = auth()->attempt($credentials)) {
			 $this->apiResponse->errorUnauthorized();
		}

		return $this->respondWithToken($token);
	}

	/**
	 * Get the authenticated User.
	 * 获取登录用户信息
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		return $this->apiResponse->item(auth()->user(),UserResource::class);
	}

	/**
	 * Log the user out (Invalidate the token).
	 * 退出登录
	 * @return \Illuminate\Http\Response
	 */
	public function logout()
	{
		auth()->logout();

		return $this->apiResponse->json(['message' => 'Successfully logged out']);
	}

	/**
	 * Refresh a token.
	 * 刷新token
	 * @return \Illuminate\Http\Response
	 */
	public function refresh()
	{
		return $this->respondWithToken(auth()->refresh());
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\Response
	 */
	protected function respondWithToken($token)
	{
		return  $this->apiResponse->json([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth()->factory()->getTTL() * 60
		]);
	}
}
