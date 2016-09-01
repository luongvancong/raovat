<?php

namespace Nht\Hocs\Users;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Users\User;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use DB;
/**
 * Class DbUserRepository.
 *
 * @author	AlvinTran
 */
class DbUserRepository extends BaseRepository implements UserRepository
{

	protected $model;
	protected $auth;

	public function __construct(User $model, Guard $auth)
	{
		$this->model = $model;
		$this->auth = $auth;
	}

	public function getByEmail($email)
	{
		return $this->model->where('email', $email)->first();
	}

	public function getActivedUser($pageSize = 20)
	{
		$this->model->where('active', 1)->paginate($pageSize);
	}

	public function getCurrentUser()
	{
		return $this->auth->user();
	}

	public function isLogged()
	{
		return $this->auth->check();
	}

	public function isAdmin()
	{
		return $this->isLogged() && $this->getCurrentUser()->hasRole(['admin']);
	}

	public function isSuperAdmin() {
		return $this->isLogged() && $this->getCurrentUser()->hasRole('superadmin');
	}

	public function createUserFromSocialite($user) {
		$dataUser = [
			'name'     => $user->getName(),
			'nickname' => $user->getName(),
			'email'    => $user->getEmail(),
			'password' => bcrypt($user->getEmail())
		];

		return $this->create($dataUser);
	}

	public function getAllUser()
	{
		return $this->model->all();
	}

	public function getUserById($id)
	{
		return $this->model->find($id);
	}


	public function deductionMoneyUserAccount($userId, $money) {
		return $this->model->where('id', $userId)->update(['money' => \DB::raw("money - {$money}")]);
	}

	public function chargeMoneyUserAccount($userId, $money) {
		return $this->model->where('id', $userId)->update(['money' => \DB::raw("money + {$money}")]);
	}

	public function isLinkToShop(User $user) {
		return $user->shop_id > 0 ? true : false;
	}

	public function isLoginUser($data){
		return Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]);
	}

	/*public function getIdUserCurrent($data){
		return $this->model->insertGetId($data);
	}*/
}
