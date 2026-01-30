<?php
require_once "../DAO/TypeDAO.php";
require_once __DIR__ . "/../models/Type.php";

class TypeController
{
	static function getTypes()
	{
		$typesObjet = [];
		$types = TypeDAO::getTypes();

		foreach ($types as $type) {
			$typesObjet[] = new Type($type["nom"], $type["id_type"]);
		}
		return $typesObjet;
	}

	static function getType($id)
	{
		$type = TypeDAO::getType($id);
		if ($type) {
			return new Type($type["nom"], $type["id_type"]);
		}
		return null;
	}
}
