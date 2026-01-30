<?php
require_once "../DAO/ClientDAO.php";
require_once __DIR__ . "/../models/Client.php";

class ClientController
{
	static function getClients()
	{
		$clientsObjet = [];
		$clients = ClientDAO::getClients();

		foreach ($clients as $client) {
			$clientsObjet[] = new Client($client["id_client"], $client["fname"], $client["lname"], $client["email"], $client["phone_number"]);
		}
		return $clientsObjet;
	}

	static function getClient($email)
	{
		$client = ClientDAO::getClient($email);
		if ($client) {
			return new Client($client["id_client"], $client["fname"], $client["lname"], $client["email"], $client["phone_number"]);
		}
		return null;
	}

	static function addClient($client)
	{
		$client = ClientDAO::addClientDAO($client);
	}
}
