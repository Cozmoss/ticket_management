<?php
require_once "../DAO/UserDAO.php";
require_once __DIR__ . "/../models/User.php";

class UserController
{
	static function getUsers()
	{
		$usersObjet = [];
		$users = UserDAO::getUsers();

		foreach ($users as $user) {
			$usersObjet[] = new User($user["fname"], $user["lname"], $user["email"], $user["phone_number"], null, $user["role_id"], $user["id_user"]);
		}
		return $usersObjet;
	}

	static function getUser($email)
	{
		$user = UserDAO::getUser($email);
		if ($user) {
			return new User($user["fname"], $user["lname"], $user["email"], $user["phone_number"], $user["password"], $user["role_id"], $user["id_user"]);
		}
		return null;
	}

	static function updateUser($user)
	{
		$user = UserDAO::updateUserDAO($user);
	}

	public static function updateUserRole($userId, $roleId)
	{
		require_once __DIR__ . "/../DAO/UserDAO.php";
		UserDAO::updateUserRole($userId, $roleId);
	}

	static function login($email, $pwd)
	{
		$user = self::getUser($email);

		if ($user === null) {
			$_SESSION["error"] = "user not found";
			return null;
		}

		$pwd_hashed = $user->getPassword();

		if (!password_verify($pwd, $pwd_hashed)) {
			$_SESSION["error"] = "wrong password";
			return null;
		}

		return $user;
	}
}
