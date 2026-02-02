<!-- Modal Modification Ticket -->
<div id="modal-ticket-<?= $ticket->getIdTicket() ?>" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Modifier le ticket</h2>
        <form action="../process/processUpdateTicket.php" method="post" class="uk-form-stacked">
        	<div uk-grid class="uk-grid uk-grid-small uk-child-width-1-2">
         		<div>
		            <input type="hidden" name="ticket_id" value="<?= $ticket->getIdTicket() ?>">
		            <div>
		                <label class="uk-form-label">Client</label>
		                <div class="uk-form-controls"><?= htmlspecialchars($clientName) ?></div>
		            </div>
           		</div>
             	<div>
            		<div>
	                  <label class="uk-form-label">Créé par</label>
	                  <div class="uk-form-controls"><?= htmlspecialchars($createdByName) ?></div>
	              </div>
              	</div>
               	<div>
		            <div>
		                <label class="uk-form-label">Device</label>
		                <div class="uk-form-controls"><?= htmlspecialchars($deviceName) ?></div>
		            </div>
                </div>
                <div>
	               	<div>
	                    <label class="uk-form-label" for="assigned_to">Assigné à</label>
	                    <select class="uk-select" id="assigned_to" name="assigned_to">
	                        <?php foreach ($users as $user): ?>
	                            <option value="<?= $user->getId() ?>" <?= $user->getId() == $ticket->getAssignedTo() ? "selected" : "" ?>>
	                                <?= htmlspecialchars($user->getFname() . " " . $user->getLname()) ?>
	                            </option>
	                        <?php endforeach; ?>
	                    </select>
	                </div>
                </div>
                <div>
	               	<div>
	                    <label class="uk-form-label" for="priority_id">Priorité</label>
	                    <select class="uk-select" id="priority_id" name="priority_id">
	                        <?php foreach ($priorities as $priority): ?>
	                            <option value="<?= $priority->getIdPriorities() ?>" <?= $priority->getIdPriorities() == $ticket->getPriorityId() ? "selected" : "" ?>>
	                                <?= htmlspecialchars($priority->getPrioritiesName()) ?>
	                            </option>
	                        <?php endforeach; ?>
	                    </select>
	                </div>
                </div>
                <div>
	               	<div>
	                    <label class="uk-form-label" for="status_id">Statut</label>
	                    <select class="uk-select" id="status_id" name="status_id">
	                        <?php foreach ($statuses as $status): ?>
	                            <option value="<?= $status->getIdStatus() ?>" <?= $status->getIdStatus() == $ticket->getStatusId() ? "selected" : "" ?>>
	                                <?= htmlspecialchars($status->getStatusName()) ?>
	                            </option>
	                        <?php endforeach; ?>
	                    </select>
	                </div>
                </div>
        	</div>
            <!-- Liste des interventions -->
            <div class="uk-margin-small">
                <label class="uk-form-label">Interventions</label>
                <?php $totalSeconds = 0; ?>
                <ul class="uk-list uk-list-divider interventions">
                    <?php foreach ($interventions as $intervention): ?>
                        <?php
                        $start = strtotime($intervention->getStartAt());
                        $end = strtotime($intervention->getEndAt());
                        $duration = $start && $end ? $end - $start : 0;
                        $totalSeconds += $duration;
                        $hours = floor($duration / 3600);
                        $minutes = floor(($duration % 3600) / 60);
                        ?>
                        <li>
                            <div class="uk-card uk-card-default uk-card-small uk-card-body uk-margin-small">
                                <div class="uk-flex uk-flex-between uk-flex-middle">
                                    <div>
                                        <span class="uk-text-bold"><?= htmlspecialchars($userNamesById[$intervention->getUserId()]) ?></span>
                                        <span class="uk-label uk-margin-small-left"><?= $hours ?>h <?= $minutes ?>m</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="uk-text-meta"><?= htmlspecialchars($intervention->getStartAt()) ?></span>
                                    <span class="uk-icon uk-margin-small-left" uk-icon="arrow-right"></span>
                                    <span class="uk-text-meta"><?= htmlspecialchars($intervention->getEndAt()) ?></span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php
                $totalHours = $totalSeconds / 3600;
                $totalMinutes = floor(($totalSeconds % 3600) / 60);
                $prix = round($totalHours * 50, 2);
                ?>
                <div class="uk-margin-small">
                    <strong>Temps total :</strong>
                    <?= floor($totalHours) ?>h <?= $totalMinutes ?>m
                </div>
                <div class="uk-margin-small">
                    <strong>Prix :</strong>
                    <?= number_format($prix, 2, ",", " ") ?> €
                </div>
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
