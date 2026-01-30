<!-- Modal Ajouter un client -->
<div id="modal-add-client" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Ajouter un client</h2>
        <form action="../process/processAddClient.php" method="post" class="uk-form-stacked">
            <!-- Champs du client -->
            <div class="uk-margin">
                <label class="uk-form-label" for="fname">Prénom</label>
                <input class="uk-input" id="fname" name="fname" type="text" required>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="lname">Nom</label>
                <input class="uk-input" id="lname" name="lname" type="text" required>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="email">Email</label>
                <input class="uk-input" id="email" name="email" type="email" required>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="phone_number">Téléphone</label>
                <input class="uk-input" id="phone_number" name="phone_number" type="text">
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-primary" type="submit">Créer le client</button>
            </div>
        </form>
    </div>
</div>
