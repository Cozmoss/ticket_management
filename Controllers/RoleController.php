<?php
require_once "../DAO/RoleDAO.php";
require_once __DIR__ . "/../models/Role.php";

class RoleController
{
	static function getRoleName($role_id)
	{
		$role = RoleDAO::getRoleName($role_id);
		if ($role) {
			return new Role($role["nom"]);
		}
		return null;
	}
}
