<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/uikit/uikit.min.css" />
    <script src="../public/js/uikit.min.js"></script>
    <script src="../public/js/uikit-icons.min.js"></script>
    <?php if (isset($statusLabels, $statusValues, $statusColors)): ?>
    <script>
    window.statusChartData = {
        labels: <?= json_encode($statusLabels) ?>,
        values: <?= json_encode($statusValues) ?>,
        colors: <?= json_encode(array_slice($statusColors, 0, count($statusLabels))) ?>
    };
    </script>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../public/js/chart.js"></script>
    <link rel="stylesheet" href="../public/css/uikit_overwrite.css">
    <link rel="stylesheet" href="../public/css/app.css">
    <title>TicketsFlow</title>
</head>
	<body>
		<?php include "notifications.php"; ?>
		<div class="uk-grid-collapse" uk-grid>
			<!-- Left Sidebar -->
			<div class="uk-width-1-6 uk-padding-small uk-visible@m uk-flex uk-flex-column uk-flex-between apk-left-menu">
    			<?php include "navbar.php"; ?>
			</div>
			<!--Menu mobile-->
			<div class="uk-padding-small uk-hidden@m uk-position-fixed uk-width-expand apk-nav-mobile" style="z-index: 9;">
				<button class="apk-btn-mobile uk-margin-small-right" uk-toggle="target: #offcanvas-nav-primary">
					<svg width="30" height="30" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class=" uk-svg" data-svg="/static/img/pictos/menu-burger.svg">
						<rect x="4" y="4" width="16" height="2"></rect>
						<rect x="4" y="10" width="16" height="2"></rect>
						<rect x="4" y="16" width="16" height="2"></rect>
					</svg>
				</button>
			</div>
			<div id="offcanvas-nav-primary" uk-offcanvas="overlay:true">
				<div class="uk-offcanvas-bar uk-flex uk-flex-column">
					<button class="uk-offcanvas-close" type="button" uk-close></button>
					<div class="uk-width-auto uk-padding-small uk-flex uk-flex-column uk-flex-between apk-left-menu"><?php include "navbar.php"; ?></div>
				</div>
			</div>

			<!-- Main Content -->
			<?= $mainContent ?>

			<?php include "add_ticket.php"; ?>
			<?php include "add_client.php"; ?>
			<?php include "add_device.php"; ?>
			<?php include "update_role.php"; ?>
			<script>
			document.addEventListener('DOMContentLoaded', function() {
			    // Quand on ouvre la modal "Ajouter un appareil"
			    UIkit.util.on('#modal-add-device', 'beforeshow', function () {
			        // Récupère le client sélectionné dans la modal ticket
			        var clientSelectTicket = document.getElementById('client_id');
			        var clientSelectDevice = document.getElementById('device_client_id');
			        if (clientSelectTicket && clientSelectDevice) {
			            clientSelectDevice.value = clientSelectTicket.value;
			        }
			    });
			});
			function openUpdateRoleModal(userId, roleId) {
			    document.getElementById('modal-user-id').value = userId;
			    var select = document.getElementById('role_client_id');
			    if (select) {
			        for (var i = 0; i < select.options.length; i++) {
			            select.options[i].selected = (select.options[i].value == roleId);
			        }
			    }
			}
			</script>
	</body>
</html>
