<?php
require_once "config/MonPDO.php";

// Toutes  les opérations CRUD
class ClientDAO
{
	public static function getClients()
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT fname, lname, email, phone_number
                    FROM clients";
		$stmt = $con->prepare($requete);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getClient($email)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_client, fname, lname, email, phone_number
                    FROM clients
                    WHERE email=:email";

		$stmt = $con->prepare($requete);
		$stmt->bindValue(":email", $email, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public static function addClientDAO($client)
	{
		$con = MONPDO::getPDO();
		$requete = "INSERT INTO clients  (fname, lname, email, phone_number)  values (:fname, :lname, :email, :phone_number)";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":fname", $client->getFname(), PDO::PARAM_STR);
		$stmt->bindValue(":lname", $client->getLname(), PDO::PARAM_STR);
		$stmt->bindValue(":email", $client->getLname(), PDO::PARAM_STR);
		$stmt->bindValue(":phone_number", $client->getLname(), PDO::PARAM_STR);

		$stmt->execute();
	}

	public static function updateClientDAO($client)
	{
		$con = MONPDO::getPDO();
		$requete = "UPDATE clients
        SET fname=:fname ,
            lname=:lname,
            email=:email,
            phone_number =:phone";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":Id", $client->getId(), PDO::PARAM_INT);
		$stmt->bindValue(":fname", $client->getFname(), PDO::PARAM_STR);
		$stmt->bindValue(":lname", $client->getLname(), PDO::PARAM_STR);
		$stmt->bindValue(":email", $client->getFname(), PDO::PARAM_STR);
		$stmt->bindValue(":phone", $client->getLname(), PDO::PARAM_STR);

		$stmt->execute();
	}

	public static function deleteClientDAO($id)
	{
		$con = MONPDO::getPDO();
		$requete = "DELETE FROM  clients WHERE Id=:Id";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":Id", $id, PDO::PARAM_INT);

		$stmt->execute();
	}
}
