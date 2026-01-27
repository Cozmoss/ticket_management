<?php
require_once "config/MonPDO.php";

class PrioritiesDAO
{
	public static function getPriorities()
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_priority, nom
                    FROM priorities";
		$stmt = $con->prepare($requete);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getPriority($id)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_priority, nom
                    FROM priorities
                    WHERE id_priority=:id";

		$stmt = $con->prepare($requete);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
}
