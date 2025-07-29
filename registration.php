<?php
// Traitement du formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    $agree = $_POST['agree'] ?? '';
    
    // Validation basique
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est requis";
    }
    
    if (empty($email)) {
        $errors[] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format d'email invalide";
    }
    
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis";
    } elseif (strlen($password) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
    }
    
    if ($password !== $password2) {
        $errors[] = "Les mots de passe ne correspondent pas";
    }
    
    if ($agree !== 'yes') {
        $errors[] = "Vous devez accepter les conditions d'utilisation";
    }
    
    // Si pas d'erreurs, traitement de l'inscription
    if (empty($errors)) {
        // Ici vous pourriez sauvegarder en base de données
        // Pour l'exemple, on affiche juste un message de succès
        $success = "Inscription réussie pour " . htmlspecialchars($username);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <title>Register</title>
    <style>
        .error { color: red; margin: 10px 0; }
        .success { color: green; margin: 10px 0; }
    </style>
</head>
<body>
<main>
    <form action="registration.php" method="post">
        <h1>Sign Up</h1>
        
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="success">
                <p><?php echo htmlspecialchars($success); ?></p>
            </div>
        <?php endif; ?>
        
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password2">Password Again:</label>
            <input type="password" name="password2" id="password2">
        </div>
        <div>
            <label for="agree">
                <input type="checkbox" name="agree" id="agree" value="yes" <?php echo (($_POST['agree'] ?? '') === 'yes') ? 'checked' : ''; ?>/> I agree
                with the
                <a href="#" title="term of services">term of services</a>
            </label>
        </div>
        <button type="submit">Register</button>
        <footer>Already a member? <a href="login.php">Login here</a></footer>
    </form>
</main>
</body>
</html>