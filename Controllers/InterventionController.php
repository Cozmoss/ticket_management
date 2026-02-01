<?php
require_once "../DAO/InterventionDAO.php";
require_once __DIR__ . "/../models/Intervention.php";

class InterventionController
{
	public static function getInterventionsByTicket($ticket_id)
	{
		return InterventionDAO::getInterventionsByTicket($ticket_id);
	}

	public static function addIntervention($ticket_id, $user_id, $start_at, $end_at)
	{
		$intervention = new Intervention($ticket_id, $user_id, $start_at, $end_at);
		InterventionDAO::addIntervention($intervention);
	}
}
