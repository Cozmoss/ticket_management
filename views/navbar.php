<div>
	<div class="apk-logo uk-margin">
		<a href="index.php">
			<img src="../public/img/logo.svg" alt="Logo"> TicketsFlow
		</a>
	</div>
	<div>
		<ul class="uk-nav">
			<li class="uk-active">
				<a href="ticket.php">
					<span class="uk-margin-small-right"><img src="../public/img/invoices.svg" alt="Tickets" /></span>
					Tickets
				</a>
			</li>
			<li class="">
				<a href="profil.php">
					<span class="uk-margin-small-right"><img src="../public/img/clients.svg" alt="Profil" /></span>
						Profil
				</a>
			</li>
			<li class="">
				<a href="contact.php">
					<span class="uk-margin-small-right"><img src="../public/img/product.svg" alt="Contact"
					/></span>
					Utilisateurs
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="uk-flex uk-flex-around uk-flex-center uk-flex-middle">
	<img src="../public/img/person.svg" alt="">
	<div class="uk-margin-small-left uk-margin-small-right apk-username">
		<?= htmlspecialchars($_SESSION["user_fname"]) ?>
        <?= htmlspecialchars($_SESSION["user_lname"]) ?>
    </div>
	<a href="../process/processLogout.php" class="uk-flex uk-flex-center uk-flex-middle uk-flex-none"><img src="../public/img/logout.svg" alt="logout" class="uk-flex-none"></a>
</div>
