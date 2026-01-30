<?php
require_once "config/MonPDO.php";

class RoleDAO
{
	public static function getRoles()
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_role, nom FROM roles";
		$stmt = $con->prepare($requete);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public static function getRoleName($role_id)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT nom
                    FROM roles
                    WHERE id_role=:id";
		$stmt = $con->prepare($requete);
		$stmt->bindValue(":id", $role_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
