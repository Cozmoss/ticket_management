<?php
require_once "bootstrap.php";
//Vérification du role
if ($_SESSION["user_role"] !== "Superviseur" && $_SESSION["user_role"] !== "Team Leader") {
	header("Location: index.php");
	exit();
}
ob_start();
?>

<div class="uk-width-expand uk-padding">
	<div class="uk-flex uk-flex-middle uk-flex-between">
		<h1>Utilisateurs</h1>
	</div>

	<div class="uk-overflow-auto">
	    <table class="uk-table uk-table-small uk-table-divider" style="max-height:1200px;">
	        <thead>
	            <tr>
	                <th>#</th>
	                <th>Nom</th>
	                <th>Prenom</th>
	                <th>Rôle</th>
	                <th>Actions</th>
	            </tr>
	        </thead>
	        <tbody>
				<?php foreach ($users as $user): ?>
				<tr>
					<td> <?php
     $userId = $user->getId();
     if (isset($ticketsResolusParUser[$userId]) && $ticketsResolusParUser[$userId] >= 15) {
     	echo '<span uk-icon="icon: arrow-up"></span>';
     }
     ?></td>
					<td><?= $user->getLname() ?></td>
					<td><?= $user->getFname() ?></td>
					<td><?php
     $roleObj = RoleController::getRoleName($user->getRole());
     echo $roleObj ? $roleObj->getRoleName() : "Inconnu";
     ?></td>
					<td>
					    <a href="#"
					       uk-toggle="target: #modal-update-role"
					       onclick="openUpdateRoleModal(<?= $user->getId() ?>, <?= $user->getRole() ?>)">
					       <img src="../public/img/edit.svg" alt="edit">
					    </a>
					</td>
				</tr>
				<?php endforeach; ?>
	        </tbody>
	    </table>
	</div>
</div>

<?php
$mainContent = ob_get_clean();
include "layout.php";


?>
