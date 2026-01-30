<?php if (isset($_GET["success"]) && $_GET["success"] === "ticket_added"): ?>
  <script>
      UIkit.notification({
          message: 'Ticket ajouté avec succès !',
          status: 'success',
          pos: 'top-center',
          timeout: 3000
      });
  </script>
<?php elseif (isset($_GET["error"]) && $_GET["error"] === "missing_field"): ?>
  <script>
      UIkit.notification({
          message: 'Erreur : un champ obligatoire est manquant. Veuillez réessayer.',
          status: 'danger',
          pos: 'top-center',
          timeout: 4000
      });
  </script>
<?php endif; ?>
<?php if (isset($_GET["success"]) && $_GET["success"] === "client_added"): ?>
    <script>
        UIkit.notification({
            message: 'Client ajouté avec succès !',
            status: 'success',
            pos: 'top-center',
            timeout: 3000
        });
    </script>
<?php elseif (isset($_GET["error"]) && $_GET["error"] === "missing_client_field"): ?>
    <script>
        UIkit.notification({
            message: 'Erreur : un champ du client est manquant.',
            status: 'danger',
            pos: 'top-center',
            timeout: 4000
        });
    </script>
<?php elseif (isset($_GET["error"]) && $_GET["error"] === "client_add_failed"): ?>
    <script>
        UIkit.notification({
            message: 'Erreur lors de l\'ajout du client.',
            status: 'danger',
            pos: 'top-center',
            timeout: 4000
        });
    </script>
<?php endif; ?>
<?php if (isset($_GET["success"]) && $_GET["success"] === "device_added"): ?>
    <script>
        UIkit.notification({
            message: 'Appareil ajouté avec succès !',
            status: 'success',
            pos: 'top-center',
            timeout: 3000
        });
    </script>
<?php elseif (isset($_GET["error"]) && $_GET["error"] === "missing_device_field"): ?>
    <script>
        UIkit.notification({
            message: 'Erreur : un champ de l\'appareil est manquant.',
            status: 'danger',
            pos: 'top-center',
            timeout: 4000
        });
    </script>
<?php elseif (isset($_GET["error"]) && $_GET["error"] === "device_add_failed"): ?>
    <script>
        UIkit.notification({
            message: 'Erreur lors de l\'ajout de l\'appareil.',
            status: 'danger',
            pos: 'top-center',
            timeout: 4000
        });
    </script>
<?php endif; ?>
<?php if (isset($_GET["success"]) && $_GET["success"] === "user_updated"): ?>
    <script>
        UIkit.notification({
            message: 'Utilisateur mis à jour !',
            status: 'success',
            pos: 'top-center',
            timeout: 3000
        });
    </script>
<?php elseif (isset($_GET["error"]) && $_GET["error"] === "user_update_failed"): ?>
    <script>
        UIkit.notification({
            message: 'Erreur lors de la mise à jour de l\'utilisateur.',
            status: 'danger',
            pos: 'top-center',
            timeout: 4000
        });
    </script>
<?php elseif (isset($_GET["error"]) && $_GET["error"] === "user_not_found"): ?>
    <script>
        UIkit.notification({
            message: 'L\'utilisateur n\'existe pas.',
            status: 'danger',
            pos: 'top-center',
            timeout: 4000
        });
    </script>
<?php endif; ?>
