<!-- Modal Update Role -->
<div id="modal-add-device" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Ajouter un appareil</h2>
        <form action="../process/processAddDevice.php" method="post" class="uk-form-stacked">
            <div class="uk-margin">
                <label class="uk-form-label" for="model">Modèle</label>
                <input class="uk-input" id="model" name="model" type="text" required>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="serial_number">Numéro de série</label>
                <input class="uk-input" id="serial_number" name="serial_number" type="text" required>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="brand">Marque</label>
                <input class="uk-input" id="brand" name="brand" type="text" required>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="type_id">Type d'appareil</label>
                <select class="uk-select" id="type_id" name="type_id" required>
                    <option value="">Sélectionner un type</option>
                    <?php if (isset($types)) {
                    	foreach ($types as $type) {
                    		echo '<option value="' . htmlspecialchars($type->getIdType()) . '">' . htmlspecialchars($type->getTypeName()) . "</option>";
                    	}
                    } ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="device_client_id">Client associé</label>
                <select class="uk-select" id="device_client_id" name="device_client_id" required>
                    <option value="">Sélectionner un client</option>
                    <?php if (isset($clients)) {
                    	foreach ($clients as $client) {
                    		echo '<option value="' . htmlspecialchars($client->getIdClient()) . '">' . htmlspecialchars($client->getFname() . " " . $client->getLname()) . "</option>";
                    	}
                    } ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="submission_date">Date de dépôt</label>
                <input class="uk-input" id="submission_date" name="submission_date" type="datetime-local" required>
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-primary" type="submit">Créer l'appareil</button>
            </div>
        </form>
    </div>
</div>
