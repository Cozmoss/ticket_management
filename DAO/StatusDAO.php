<?php
require_once "config/MonPDO.php";

class StatusDAO
{
	public static function getStatus()
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_status, nom
                    FROM status";
		$stmt = $con->prepare($requete);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getStatu($id)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_status, nom
                    FROM status
                    WHERE id_status=:id";

		$stmt = $con->prepare($requete);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
}
