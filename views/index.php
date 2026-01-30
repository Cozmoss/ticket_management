<?php
require_once "bootstrap.php";
ob_start();
?>

<!-- Main Content -->
<div class="uk-width-expand uk-padding">
	<div class="uk-flex uk-flex-middle uk-flex-between">
		<h1>Tickets</h1>
		<button class="uk-button uk-button-primary" uk-toggle="target: #modal-add-ticket">Ajouter un ticket <img src="../public/img/add.svg" alt="ajouter"></button>
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
						<td><?php
      $createdById = $ticket->getCreatedBy();
      echo $userNamesById[$createdById];
      ?>
						</td>
						<td> <?php
      $assignedToId = $ticket->getAssignedTo();
      echo $userNamesById[$assignedToId];
      ?>
						</td>
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
						<td><?php
      $createdById = $ticket->getCreatedBy();
      echo $userNamesById[$createdById];
      ?>
						</td>
						<td> <?php
      $assignedToId = $ticket->getAssignedTo();
      echo $userNamesById[$assignedToId];
      ?>
						</td>
						<td>Actions</td>
					</tr>
					<?php endforeach; ?>
				<?php endif; ?>
	        </tbody>
	    </table>
	</div>
	<?php endif; ?>
</div>

<?php
$mainContent = ob_get_clean();
include "layout.php";


?>
