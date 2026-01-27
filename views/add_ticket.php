<?php
require_once "../Controllers/PrioritiesController.php";
require_once "../Controllers/TicketController.php";
require_once "../Controllers/UserController.php";
require_once "../Controllers/StatusController.php";
require_once "../models/Priority.php";
require_once "../models/User.php";
require_once "../models/Status.php";

// Récupération des listes pour les selects
$priorities = PrioritiesController::getPriorities();
$users = UserController::getUsers();
$statuses = StatusController::getStatus();

// Pour le client et le device, il faudrait avoir des DAO/Controllers correspondants.
// Ici, on simule des listes vides ou à compléter.
$clients = []; // À remplacer par ClientController::getClients() si dispo
$devices = []; // À remplacer par DeviceController::getDevices() si dispo

// Génération du prochain numéro de ticket au format TCK-YYYY-NNNN
date_default_timezone_set("Europe/Paris");
$year = date("Y");
$tickets = TicketController::getTickets();
$lastNumber = 0;
foreach ($tickets as $ticket) {
	if (preg_match('/^TCK-(\d{4})-(\d{4})$/', $ticket->getTicketNumber(), $matches)) {
		if ($matches[1] == $year && (int) $matches[2] > $lastNumber) {
			$lastNumber = (int) $matches[2];
		}
	}
}
$nextTicketNumber = sprintf("TCK-%s-%04d", $year, $lastNumber + 1);
?>

<!-- Modal Add Ticket -->
<div id="modal-add-ticket" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Ajouter un ticket</h2>
        <form action="../process/processAddTicket.php" method="post" class="uk-form-stacked">
            <div class="uk-margin">
                <label class="uk-form-label" for="ticket_number">Numéro du ticket</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="ticket_number" name="ticket_number" type="text" value="<?= htmlspecialchars($nextTicketNumber) ?>" readonly>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="client_id">Client</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="client_id" name="client_id" required>
                        <option value="">Sélectionner un client</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $client->getIdClient() ?>">
                                <?= htmlspecialchars($client->getFname() . " " . $client->getLname()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="device_id">Appareil</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="device_id" name="device_id" required>
                        <option value="">Sélectionner un appareil</option>
                        <?php foreach ($devices as $device): ?>
                            <option value="<?= $device->getIdDevice() ?>">
                                <?= htmlspecialchars($device->getModel()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="status_id">Statut</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="status_id" name="status_id" required>
                        <option value="">Sélectionner un statut</option>
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?= $status->getIdStatus() ?>">
                                <?= htmlspecialchars($status->getStatusName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="priority_id">Priorité</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="priority_id" name="priority_id" required>
                        <option value="">Sélectionner une priorité</option>
                        <?php foreach ($priorities as $priority): ?>
                            <option value="<?= $priority->getIdPriorities() ?>">
                                <?= htmlspecialchars($priority->getPrioritiesName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="assigned_to">Assigné à</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="assigned_to" name="assigned_to" required>
                        <option value="">Sélectionner un utilisateur</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user->getId() ?>">
                                <?= htmlspecialchars($user->getFname() . " " . $user->getLname()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- Champ caché pour le créateur -->
            <input type="hidden" name="created_by" value="<?= $_SESSION["id_user"] ?>">
            <div class="uk-margin">
                <button class="uk-button uk-button-primary" type="submit">Créer le ticket</button>
            </div>
        </form>
    </div>
</div>
