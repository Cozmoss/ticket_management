<?php
require_once "config/MonPDO.php";

// Toutes  les opérations CRUD
class UserDAO
{
	public static function getUsers()
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_user, fname, lname, email, phone_number , role_id, `nom` as `role`
                    FROM users
                    JOIN roles
                    ON role_id=id_role";
		$stmt = $con->prepare($requete);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getUser($email)
	{
		$con = MONPDO::getPDO();
		$requete = "SELECT id_user, fname, lname, email, phone_number , `password` , role_id, `nom` as `role`
                    FROM users
                    JOIN roles
                    ON role_id=id_role
                    WHERE email=:email";

		$stmt = $con->prepare($requete);
		$stmt->bindValue(":email", $email, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public static function addUserDAO($user)
	{
		$con = MONPDO::getPDO();
		$requete = "INSERT INTO users  (fname, lname, email, phone_number, `password`, role_id )  values (:fname, :lname, :email, :phone_number, :`password`, :role_id )";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":fname", $user->getFname(), PDO::PARAM_STR);
		$stmt->bindValue(":lname", $user->getLname(), PDO::PARAM_STR);
		$stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
		$stmt->bindValue(":phone_number", $user->getPhone(), PDO::PARAM_STR);
		$stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
		$stmt->bindValue(":role_id", $user->getRole(), PDO::PARAM_INT);

		$stmt->execute();
	}

	public static function updateUserDAO($user)
	{
		$con = MONPDO::getPDO();
		$requete = "UPDATE users
        SET fname=:fname ,
            lname=:lname,
            email=:email,
            phone_number =:phone,
            role_id =:role_id,
            password = :password
             WHERE id_user=:Id";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":Id", $user->getId(), PDO::PARAM_INT);
		$stmt->bindValue(":fname", $user->getFname(), PDO::PARAM_STR);
		$stmt->bindValue(":lname", $user->getLname(), PDO::PARAM_STR);
		$stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
		$stmt->bindValue(":phone", $user->getPhone(), PDO::PARAM_STR);
		$stmt->bindValue(":role_id", $user->getRole(), PDO::PARAM_INT);
		$stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);

		$stmt->execute();
	}

	public static function deleteUserDAO($id)
	{
		$con = MONPDO::getPDO();
		$requete = "DELETE FROM  users WHERE Id=:Id";
		$stmt = $con->prepare($requete);

		$stmt->bindValue(":Id", $id, PDO::PARAM_INT);

		$stmt->execute();
	}

	public static function updateUserRole($userId, $roleId)
	{
		$con = MONPDO::getPDO();
		$requete = "UPDATE users SET role_id = :role_id WHERE id_user = :id";
		$stmt = $con->prepare($requete);
		$stmt->bindValue(":role_id", $roleId, PDO::PARAM_INT);
		$stmt->bindValue(":id", $userId, PDO::PARAM_INT);
		$stmt->execute();
	}
}
