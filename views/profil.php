<?php
require_once "bootstrap.php";
ob_start();
?>

<!-- Main Content -->
<main class="uk-width-expand uk-padding uk-margin-large-top">
<div>
	<div class="uk-flex uk-flex-middle uk-flex-between">
		<h1>Profil</h1>
	</div>

	<form action="../process/processUpdateUser.php" method="post" class="uk-form-stacked">
		<div uk-grid class="uk-grid uk-child-width-1-2">
            <div class="">
                <label class="uk-form-label" for="name">Nom</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="name" name="lname" type="text" value="<?= $user->getLname() ?>">
                </div>
            </div>
            <div class="">
	           	<label class="uk-form-label" for="firstname">Prénom</label>
	            <div class="uk-form-controls">
	                <input class="uk-input" id="firstname" name="fname" type="text" value="<?= $user->getFname() ?>">
	            </div>
            </div>
            <div class="">
	           	<label class="uk-form-label" for="mail">Email</label>
	            <div class="uk-form-controls">
	                <input class="uk-input" id="mail" name="email" type="mail" value="<?= $user->getEmail() ?>">
	            </div>
            </div>
            <div class="">
	           	<label class="uk-form-label" for="phone">Numéro de téléphone</label>
	            <div class="uk-form-controls">
	                <input class="uk-input" id="phone" name="phone" type="phone" value="<?= $user->getPhone() ?>">
	            </div>
            </div>
            <div class="">
	           	<label class="uk-form-label" for="password">Nouveau mot de passe</label>
	            <div class="uk-form-controls">
	                <input class="uk-input" id="password" name="password" type="password">
	            </div>
            </div>
            <!-- Champ caché pour le créateur -->
            <input type="hidden" name="id" value="<?= $_SESSION["id_user"] ?>">
            <div class="uk-width-1-1">
                <button class="uk-button uk-button-primary" type="submit">Mettre à jour</button>
            </div>
		</div>
    </form>

</div>
</main>

<?php
$mainContent = ob_get_clean();
include "layout.php";


?>
