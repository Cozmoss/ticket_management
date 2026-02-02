<div>
	<div class="apk-logo uk-margin">
		<a href="index.php">
			<img src="../public/img/logo.svg" alt="Logo"> TicketsFlow
		</a>
	</div>
	<div>
		<ul class="uk-nav">
			<li class="<?= $currentPage === "index.php" ? "uk-active" : "" ?>" >
				<a href="index.php">
					<span class="uk-margin-small-right"><img src="../public/img/invoices.svg" alt="Tickets" /></span>
					Tickets
				</a>
			</li>
			<li class="<?= $currentPage === "profil.php" ? "uk-active" : "" ?>">
				<a href="profil.php">
					<span class="uk-margin-small-right"><img src="../public/img/clients.svg" alt="Profil" /></span>
						Profil
				</a>
			</li>
			<?php if ($_SESSION["user_role"] === "Superviseur" || $_SESSION["user_role"] === "Team Leader"): ?>
			<li class="<?= $currentPage === "user.php" ? "uk-active" : "" ?>">
				<a href="user.php">
					<span class="uk-margin-small-right"><img src="../public/img/product.svg" alt="Contact"
					/></span>
					Utilisateurs
				</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<div class="uk-flex uk-flex-around uk-flex-center uk-flex-middle">
	<a href="/profil.php" class=""><img src="../public/img/person.svg" alt=""></a>
	<div class="uk-margin-small-left uk-margin-small-right apk-username">
		<?= htmlspecialchars($_SESSION["user_fname"]) ?>
        <?= htmlspecialchars($_SESSION["user_lname"]) ?>
    </div>
	<a href="../process/processLogout.php" class="uk-flex uk-flex-center uk-flex-middle uk-flex-none"><img src="../public/img/logout.svg" alt="logout" class="uk-flex-none"></a>
</div>
