<!-- Modal Update Role -->
<div id="modal-update-role" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Modifier le rôle de l'utilisateur</h2>
        <form action="../process/processUpdateRole.php" method="post" class="uk-form-stacked">
	        <div class="uk-margin">
	            <label class="uk-form-label" for="role_client_id">Rôle</label>
	            <select class="uk-select" id="role_client_id" name="role_client_id" required>
	                <?php if (isset($roles)) {
                 	foreach ($roles as $role) {
                 		$selected = isset($currentRoleId) && $role->getIdRole() == $currentRoleId ? "selected" : "";
                 		echo '<option value="' . htmlspecialchars($role->getIdRole()) . '">' . htmlspecialchars($role->getRoleName()) . "</option>";
                 	}
                 } ?>
	            </select>
	        </div>
			<input type="hidden" name="user_id" id="modal-user-id" value="">

            <div class="uk-margin">
                <button class="uk-button uk-button-primary" type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
