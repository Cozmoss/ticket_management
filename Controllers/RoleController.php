<?php
require_once "../DAO/RoleDAO.php";
require_once __DIR__ . "/../models/Role.php";

class RoleController
{
	public static function getRoles()
	{
		$rolesObjet = [];
		$roles = RoleDAO::getRoles();
		foreach ($roles as $role) {
			$rolesObjet[] = new Role($role["nom"], $role["id_role"]);
		}
		return $rolesObjet;
	}
	static function getRoleName($role_id)
	{
		$role = RoleDAO::getRoleName($role_id);
		if ($role) {
			return new Role($role["nom"]);
		}
		return null;
	}
}
