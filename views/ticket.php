<!-- Modal Modification Ticket -->
<div id="modal-ticket-<?= $ticket->getIdTicket() ?>" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Modifier le ticket</h2>
        <form action="../process/processUpdateTicket.php" method="post" class="uk-form-stacked">
            <input type="hidden" name="ticket_id" value="<?= $ticket->getIdTicket() ?>">
            <div class="uk-margin">
                <label class="uk-form-label">Client</label>
                <div class="uk-form-controls"><?= htmlspecialchars($clientName) ?></div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Device</label>
                <div class="uk-form-controls"><?= htmlspecialchars($deviceName) ?></div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="priority_id">Priorité</label>
                <select class="uk-select" id="priority_id" name="priority_id">
                    <?php foreach ($priorities as $priority): ?>
                        <option value="<?= $priority->getIdPriorities() ?>" <?= $priority->getIdPriorities() == $ticket->getPriorityId() ? "selected" : "" ?>>
                            <?= htmlspecialchars($priority->getPrioritiesName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="status_id">Statut</label>
                <select class="uk-select" id="status_id" name="status_id">
                    <?php foreach ($statuses as $status): ?>
                        <option value="<?= $status->getIdStatus() ?>" <?= $status->getIdStatus() == $ticket->getStatusId() ? "selected" : "" ?>>
                            <?= htmlspecialchars($status->getStatusName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Créé par</label>
                <div class="uk-form-controls"><?= htmlspecialchars($createdByName) ?></div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="assigned_to">Assigné à</label>
                <select class="uk-select" id="assigned_to" name="assigned_to">
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->getId() ?>" <?= $user->getId() == $ticket->getAssignedTo() ? "selected" : "" ?>>
                            <?= htmlspecialchars($user->getFname() . " " . $user->getLname()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Liste des interventions -->
            <div class="uk-margin">
                <label class="uk-form-label">Interventions</label>
                <ul class="uk-list">
                    <?php foreach ($interventions as $intervention): ?>
                        <li>
                            <?= htmlspecialchars($userNamesById[$intervention->getUserId()] ?? "Inconnu") ?> :
                            <?= htmlspecialchars($intervention->getStartAt()) ?> → <?= htmlspecialchars($intervention->getEndAt()) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- Ajout d'une intervention -->
            <div class="uk-margin">
                <label class="uk-form-label">Ajouter une intervention</label>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-1-3">
                        <select class="uk-select" name="intervention_user_id">
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user->getId() ?>"><?= htmlspecialchars($user->getFname() . " " . $user->getLname()) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="uk-width-1-3">
                        <input class="uk-input" type="datetime-local" name="intervention_start_at">
                    </div>
                    <div class="uk-width-1-3">
                        <input class="uk-input" type="datetime-local" name="intervention_end_at">
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-primary" type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
