<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de la réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .confirmation-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            max-width: 700px;
            margin: 80px auto;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<?= view('templates/navbar'); ?>

<div class="confirmation-box text-center">
    <h2 class="mb-4"><i class="bi bi-exclamation-circle-fill text-warning"></i> Confirmation de la réservation</h2>
    <p class="lead">Merci de confirmer votre souhait de réserver le logement suivant :</p>

    <ul class="list-group my-4 text-start">
        <li class="list-group-item"><strong>🏠 Logement :</strong> <?= esc($logement['nom']) ?></li>
        <li class="list-group-item"><strong>🧍 Capacité :</strong> <?= esc($logement['capacite']) ?> personnes</li>
        <li class="list-group-item"><strong>📍 Type :</strong> <?= esc($logement['type']) ?></li>
        <li class="list-group-item"><strong>📅 Du :</strong> <?= esc($date_debut) ?> <strong>au</strong> <?= esc($date_fin) ?></li>
    </ul>

    <form method="post" action="<?= base_url('reservation/validerReservation') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="id_logement" value="<?= esc($logement['id_logement']) ?>">
        <input type="hidden" name="date_debut" value="<?= esc($date_debut) ?>">
        <input type="hidden" name="date_fin" value="<?= esc($date_fin) ?>">

        <button type="submit" class="btn btn-success px-4 me-2"><i class="bi bi-check-circle-fill"></i> Confirmer</button>
        <a href="<?= base_url('reservation') ?>" class="btn btn-secondary px-4"><i class="bi bi-x-circle"></i> Annuler</a>
    </form>
</div>

</body>
</html>
