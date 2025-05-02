<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">CVVEN</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/reservation">Réserver</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/info">Infos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/testdb">Tests DB</a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto">
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
