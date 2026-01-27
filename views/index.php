<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
	header("Location: login.php");
}

require_once "../Controllers/UserController.php";
require_once "../models/User.php";
require_once "../Controllers/TicketController.php";
require_once "../models/Ticket.php";
require_once "../Controllers/PrioritiesController.php";
require_once "../models/Priority.php";

$users = UserController::getUsers();
$priorities = PrioritiesController::getPriorities();

// Si superviseur ou team leader, on récupère tous les tickets, sinon seulement ceux assignés à l'utilisateur
if ($_SESSION["user_role"] === "Superviseur" || $_SESSION["user_role"] === "Team Leader") {
	$allTickets = TicketController::getTickets();
} else {
	$allTickets = TicketController::getTicketsByAssigned($_SESSION["id_user"]);
}
$tickets = $allTickets; // On filtre $tickets pour le premier tableau

// Gestion des priorités sélectionnées (checkboxes)
$priorityNames = array_map(function ($priority) {
	return $priority->getPrioritiesName();
}, $priorities);

$selectedPriorities = isset($_GET["priority"]) ? (array) $_GET["priority"] : [];
$selectedPriorities = array_filter($selectedPriorities); // remove empty values

if (!empty($selectedPriorities)) {
	$tickets = array_filter($tickets, function ($ticket) use ($selectedPriorities) {
		return in_array($ticket->getPriorityName(), $selectedPriorities);
	});
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/uikit.min.css" />
    <script src="../public/js/uikit.min.js"></script>
    <script src="../public/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>TicketsFlow</title>
</head>
	<body>
		<?php include "notifications.php"; ?>
		<div class="uk-grid-collapse" uk-grid>
			<!-- Left Sidebar -->
			<div class="uk-width-1-6 uk-padding-small uk-visible@m uk-flex uk-flex-column uk-flex-between apk-left-menu">
    			<?php include "navbar.php"; ?>
			</div>
			<!--Menu mobile-->
			<div class="uk-padding-small uk-hidden@m uk-position-fixed">
				<button class="apk-btn-mobile uk-margin-small-right" uk-toggle="target: #offcanvas-nav-primary">
					<svg width="30" height="30" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class=" uk-svg" data-svg="/static/img/pictos/menu-burger.svg">
						<rect x="4" y="4" width="16" height="2"></rect>
						<rect x="4" y="10" width="16" height="2"></rect>
						<rect x="4" y="16" width="16" height="2"></rect>
					</svg>
				</button>
			</div>
			<div id="offcanvas-nav-primary" uk-offcanvas="overlay:true">
				<div class="uk-offcanvas-bar uk-flex uk-flex-column">
					<button class="uk-offcanvas-close" type="button" uk-close></button>
					<div class="uk-width-auto uk-padding-small uk-flex uk-flex-column uk-flex-between apk-left-menu"><?php include "navbar.php"; ?></div>
				</div>
			</div>

			<!-- Main Content -->
			<div class="uk-width-expand uk-padding">
				<div class="uk-flex uk-flex-middle uk-flex-between">
					<h1>Tickets</h1>
					<button class="uk-button uk-button-primary" uk-toggle="target: #modal-add-ticket">Ajouter un ticket <img src="../public/img/add.svg" alt="ajouter"></button>
					<?php include "add_ticket.php"; ?>
				</div>
				<div uk-grid class="uk-grid uk-child-width-1-1 uk-child-width-1-3@m" uk-height-match="target: div>div>.uk-list">
					<!-- Card DERNIER TICKET RESOLU -->
					<div>
						<?php
      // Filtrer les tickets résolus pour l'utilisateur courant
      $ticketsResolus = array_filter($allTickets, function ($ticket) {
      	return strtolower($ticket->getStatusName()) === "resolu";
      });
      // Compteur
      $nbResolus = count($ticketsResolus);
      // Trier du plus récent au plus vieux
      usort($ticketsResolus, function ($a, $b) {
      	return $b->getIdTicket() <=> $a->getIdTicket();
      });
      // Les 4 derniers tickets résolus
      $lastResolus = array_slice($ticketsResolus, 0, 4);
      ?>
						<div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
							<div class="uk-flex uk-flex-between uk-flex-middle">
								<h3 class="uk-card-title">DERNIER TICKET RESOLU</h3>
								<span class="uk-label"><?= $nbResolus ?>/15</span>
							</div>
							<ul class="uk-list uk-list-divider uk-margin-small-top">
								<?php if (empty($lastResolus)): ?>
									<li>Aucun ticket résolu</li>
								<?php else: ?>
									<?php foreach ($lastResolus as $ticket): ?>
										<li>
											<span class="uk-text-bold"><?= $ticket->getStatusName() ?></span>
											-
											<span><?= $ticket->getClientName() ?></span>
										</li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<!-- Card TICKETS PRIORITAIRE -->
					<div>
						<?php
      // Filtrer les tickets avec priorité haute
      $ticketsHaute = array_filter($allTickets, function ($ticket) {
      	return strtolower($ticket->getPriorityName()) === "haute";
      });
      // Trier du plus récent au plus vieux
      usort($ticketsHaute, function ($a, $b) {
      	return $b->getIdTicket() <=> $a->getIdTicket();
      });
      // Les 4 derniers tickets haute priorité
      $lastHaute = array_slice($ticketsHaute, 0, 4);
      ?>
						<div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
							<h3 class="uk-card-title">TICKETS PRIORITAIRE</h3>
							<ul class="uk-list uk-list-divider uk-margin-small-top">
								<?php if (empty($lastHaute)): ?>
									<li>Aucun ticket haute priorité</li>
								<?php else: ?>
									<?php foreach ($lastHaute as $ticket): ?>
										<li>
											<span class="uk-text-bold"><?= $ticket->getPriorityName() ?></span>
											-
											<span><?= $ticket->getClientName() ?></span>
										</li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div>
						<div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
							<h3 class="uk-card-title">CHART</h3>
							<ul class="uk-list uk-list-divider uk-margin-small-top">

							</ul>
						</div>
					</div>
				</div>

				<!-- Checkboxes pour filtrer par priorité -->
				<form method="get" id="priorityFilterForm" style="margin-bottom: 20px;">
					<label>Filtrer par priorité :</label><br>
					<?php foreach ($priorityNames as $name): ?>
						<label style="margin-right: 15px;">
							<input type="checkbox" name="priority[]" value="<?= htmlspecialchars($name) ?>"
								<?= in_array($name, $selectedPriorities) ? "checked" : "" ?>
								onchange="document.getElementById('priorityFilterForm').submit();"
							>
							<?= htmlspecialchars($name) ?>
						</label>
					<?php endforeach; ?>
				</form>

				<div class="uk-overflow-auto">
				    <table class="uk-table uk-table-small uk-table-divider">
				        <thead>
				            <tr>
				                <th>#</th>
				                <th>Nom du client</th>
				                <th>Device</th>
				                <th>Status</th>
				                <th>Priorité</th>
				                <th>Crée par</th>
				                <th>Assigné à</th>
				                <th>Actions</th>
				            </tr>
				        </thead>
				        <tbody>
							<?php if (empty($tickets)): ?>
								<tr>
									<td colspan="8">Aucun ticket pour cette priorité</td>
								</tr>
							<?php else: ?>
								<?php foreach ($tickets as $ticket): ?>
								<tr>
									<td><?= $ticket->getTicketNumber() ?></td>
									<td><?= $ticket->getClientName() ?></td>
									<td><?= $ticket->getDeviceName() ?></td>
									<td><?= $ticket->getStatusName() ?></td>
									<td><?= $ticket->getPriorityName() ?></td>
									<td><?= $ticket->getCreatedBy() ?></td>
									<td><?= $ticket->getAssignedTo() ?></td>
									<td>Actions</td>
								</tr>
								<?php endforeach; ?>
							<?php endif; ?>
				        </tbody>
				    </table>
				</div>
				<?php if ($_SESSION["user_role"] === "Superviseur" || $_SESSION["user_role"] === "Team Leader"): ?>
				<h2>Ticket en attente</h2>
				<div class="uk-overflow-auto">
				    <table class="uk-table uk-table-small uk-table-divider">
				        <thead>
				            <tr>
				                <th>#</th>
				                <th>Nom du client</th>
				                <th>Device</th>
				                <th>Status</th>
				                <th>Priorité</th>
				                <th>Crée par</th>
				                <th>Assigné à</th>
				                <th>Actions</th>
				            </tr>
				        </thead>
				        <tbody>
							<?php $ticketsEnAttente = array_filter($allTickets, function ($ticket) {
       	return strtolower($ticket->getStatusName()) === "en attente";
       }); ?>
							<?php if (empty($ticketsEnAttente)): ?>
								<tr>
									<td colspan="8">Pas de ticket en attente</td>
								</tr>
							<?php else: ?>
								<?php foreach ($ticketsEnAttente as $ticket): ?>
								<tr>
									<td><?= $ticket->getTicketNumber() ?></td>
									<td><?= $ticket->getClientName() ?></td>
									<td><?= $ticket->getDeviceName() ?></td>
									<td><?= $ticket->getStatusName() ?></td>
									<td><?= $ticket->getPriorityName() ?></td>
									<td><?= $ticket->getCreatedBy() ?></td>
									<td><?= $ticket->getAssignedTo() ?></td>
									<td>Actions</td>
								</tr>
								<?php endforeach; ?>
							<?php endif; ?>
				        </tbody>
				    </table>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</body>
</html>
