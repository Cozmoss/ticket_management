<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php session_start(); ?>
    <link rel="stylesheet" href="../public/css/uikit/uikit.min.css" />
    <script src="../public/js/uikit.min.js"></script>
    <script src="../public/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="../public/css/login.css">
    <title>Connexion</title>
</head>

<body class="login-page uk-background-cover">

<div class="login-container">

    <!-- ✅ IMPORTANT : action vers le fichier process (pas vers UserController.php) -->
    <form action="../process/processLogin.php" method="POST" class="login-form">
        <h1 class="uk-h1">Bienvenue</h1>
        <p>Accédez à votre espace de l'app</p>

        <div class="input-group">
            <label>Email de l'utilisateur</label>
            <input
                type="email"
                name="email"
                placeholder="Entrez votre email"

                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
            >
        </div>

        <div class="input-group">
            <label>Mot de passe</label>
            <input
                type="password"
                name="password"
                placeholder="••••••••"

            >
        </div>

        <input type="submit" value="Se connecter" class="uk-button uk-button-primary">

        <?php if (!empty($_SESSION["error"])): ?>
            <div class="error">
                <?= htmlspecialchars($_SESSION["error"]) ?>
            </div>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?>

    </form>

</div>

</body>
</html>
