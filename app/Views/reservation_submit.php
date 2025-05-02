<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation - DevlaRoom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?= view('templates/navbar'); ?>

<div class="container mt-5">
    <div class="alert alert-success text-center p-5 rounded-4 shadow">
        <h2><i class="bi bi-check-circle-fill"></i> Réservation confirmée !</h2>
        <p class="lead">Merci pour votre réservation. Voici les détails :</p>
        <ul class="list-group text-start">
            <li class="list-group-item"><strong>🏠 Logement :</strong> <?= esc($logement['nom']) ?></li>
            <li class="list-group-item"><strong>🧍 Capacité :</strong> <?= esc($logement['capacite']) ?> personnes</li>
            <li class="list-group-item"><strong>🏷️ Type :</strong> <?= esc($logement['type']) ?></li>
            <li class="list-group-item"><strong>📅 Du :</strong> <?= esc($date_debut) ?> <strong>au</strong> <?= esc($date_fin) ?></li>
        </ul>
        <a href="<?= base_url('/dashboard') ?>" class="btn btn-success mt-4 px-4">Retour au tableau de bord</a>
    </div>
</div>

</body>
</html>
