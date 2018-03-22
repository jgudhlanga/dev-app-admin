<?php

namespace App\Http\Controllers\Users\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\Users\User;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ModuleController
 * @package App\Http\Controllers\Cpanel\Modules\Api
 */
class UsersController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var UserService
	 */
	protected $userService;
	
	/**
	 * UsersController constructor.
	 * @param UserService $userService
	 */
	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}
	
	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getUsers()
	{
		$users = $this->userService->findBy(null,null, null, null, ['first_name' => 'asc']);
		return Datatables::of($users)->make(true);
	}
	
	/**
	 * @param Request $request
	 * @param User $user
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function changeStatus(Request $request, User $user)
	{
		try
		{
			DB::beginTransaction();
			$status = ($user->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$user = $this->userService->update($user, ['status_id' => $status]);
			DB::commit();
			$message = ($user->status_id == $this->getStatusActive()) ? 'users.alerts.reactivated' : 'users.alerts.deactivated';
			return response()->json(['user' => $user, 'message' => trans($message)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	public function uploadProfilePicture(User $user, Request $request)
	{
		$user = $this->userService->uploadProfilePicture($user, $request);
		return redirect()->route('users.show', ['id' => $user->id]);
	}
}
