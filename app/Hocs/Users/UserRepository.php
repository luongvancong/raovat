<?php

namespace Nht\Hocs\Users;

/**
 * Interface description.
 *
 * @author	AlvinTran
 */
interface UserRepository
{
	public function getByEmail($email);
	public function getActivedUser($pageSize);
	public function getCurrentUser();
	public function isLogged();
	public function isAdmin();

    /**
     * Create user from socialite
     * @param  Socialite $user
     * @return User
     */
    public function createUserFromSocialite($user);


    /**
     * Trừ tiền trong tài khoản user
     * @param  int $userId
     * @param  int $money
     * @return mixed
     */
    public function deductionMoneyUserAccount($userId, $money);


    /**
     * Nạp tiền vào tài khoản user
     * @param  int $userId
     * @param  int $money
     * @return mixed
     */
    public function chargeMoneyUserAccount($userId, $money);

    /**
     * Kiểm tra xem user đã liên kết với shop chưa
     * @param  User    $user
     * @return boolean
     */
    public function isLinkToShop(User $user);
}