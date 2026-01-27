<?php
require_once "../DAO/PrioritiesDAO.php";
require_once __DIR__ . "/../models/Priority.php";

class PrioritiesController
{
	static function getPriorities()
	{
		$prioritiesObjet = [];
		$priorities = PrioritiesDAO::getPriorities();

		foreach ($priorities as $priority) {
			$prioritiesObjet[] = new Priorities($priority["nom"], $priority["id_priority"]);
		}
		return $prioritiesObjet;
	}

	static function getPriority($id)
	{
		$priority = PrioritiesDAO::getPriority($id);
		if ($priority) {
			return new Priorities($priority["nom"], $priority["id_priority"]);
		}
		return null;
	}
}
