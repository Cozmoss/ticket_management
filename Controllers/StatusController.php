<?php
require_once "../DAO/StatusDAO.php";
require_once __DIR__ . "/../models/Status.php";

class StatusController
{
	static function getStatus()
	{
		$statusObjet = [];
		$status = StatusDAO::getStatus();

		foreach ($status as $statu) {
			$statusObjet[] = new Status($statu["nom"], $statu["id_status"]);
		}
		return $statusObjet;
	}

	static function getStatu($id)
	{
		$status = StatusDAO::getStatu($id);
		if ($status) {
			return new Status($status["nom"], $status["id_status"]);
		}
		return null;
	}
}
