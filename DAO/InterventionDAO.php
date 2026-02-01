<?php
require_once "config/MonPDO.php";
require_once __DIR__ . "/../models/Intervention.php";

class InterventionDAO
{
	public static function getInterventionsByTicket($ticket_id)
	{
		$con = MONPDO::getPDO();
		$stmt = $con->prepare("SELECT * FROM intervention WHERE ticket_id = :ticket_id ORDER bY start_at DESC");
		$stmt->bindValue(":ticket_id", $ticket_id, PDO::PARAM_INT);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$interventions = [];
		foreach ($rows as $row) {
			$interventions[] = new Intervention($row["ticket_id"], $row["user_id"], $row["start_at"], $row["end_at"]);
		}
		return $interventions;
	}

	public static function addIntervention($intervention)
	{
		$con = MONPDO::getPDO();
		$stmt = $con->prepare("INSERT INTO intervention (ticket_id, user_id, start_at, end_at) VALUES (:ticket_id, :user_id, :start_at, :end_at)");
		$stmt->bindValue(":ticket_id", $intervention->getTicketId(), PDO::PARAM_INT);
		$stmt->bindValue(":user_id", $intervention->getUserId(), PDO::PARAM_INT);
		$stmt->bindValue(":start_at", $intervention->getStartAt());
		$stmt->bindValue(":end_at", $intervention->getEndAt());
		$stmt->execute();
	}
}
