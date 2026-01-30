<?php
require_once "config/MonPDO.php";

class TypeDAO
{
	public static function getTypes()
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_type, nom
                    FROM types";
		$stmt = $con->prepare($requete);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getType($id)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_type, nom
                    FROM types
                    WHERE id_type=:id";

		$stmt = $con->prepare($requete);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
}
