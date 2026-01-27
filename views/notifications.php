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
