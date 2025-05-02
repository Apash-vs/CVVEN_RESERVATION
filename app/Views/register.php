<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="auth-body">
<?= view('templates/navbar'); ?>

    <div class="wrapper">
        <!-- Formulaire de connexion -->
        <form id="login-form" class="active" action="#" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Nom D'Utilisateur" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Mot De Passe" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Se souvenir de moi</label>
                <a href="#">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Vous n'avez pas de coddmpte ? <a href="#" onclick="showRegisterForm()">Créer un compte</a></p>
            </div>
        </form>

        <!-- Formulaire de création de compte -->
        <form id="register-form" action="<?= base_url('register/submit') ?>" method="post">

            <h1>Créer un compte</h1>

            <?php if(session()->getFlashdata('success')): ?>
                <p style="color: green"><?= session()->getFlashdata('success') ?></p>
            <?php endif; ?>

            <div class="input-box">
                <input type="text" name="username" placeholder="Nom D'Utilisateur" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Mot De Passe" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            
            <button type="submit" class="btn">Créer ssun compte</button>

            <div class="login-link">
                <p>Déjà un compte ? <a href="#" onclick="showLoginForm()">Connectez-vous</a></p>
            </div>
        </form>
    </div>

    <script>
        function showRegisterForm() {
            document.getElementById("login-form").classList.remove("active");
            document.getElementById("register-form").classList.add("active");
        }

        function showLoginForm() {
            document.getElementById("register-form").classList.remove("active");
            document.getElementById("login-form").classList.add("active");
        }
    </script>

    <style>
        .wrapper form {
            display: none;
        }

        .wrapper form.active {
            display: block;
        }
    </style>
</body>
</html>