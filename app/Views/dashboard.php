<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - CVVEN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <!-- À ajouter dans le <head> si ce n’est pas encore fait -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
<?= view('templates/navbar'); ?>  


<div class="container mt-5">
    <h5><i class="bi bi-person-circle"></i> Profil</h5>
    <ul class="list-unstyled">
        <li><strong>Nom d'utilisateur :</strong> <?= esc($user['username']) ?></li>
        <li><strong>Email :</strong> <?= esc($user['email']) ?></li>
        <p><strong>Pays d’origine :</strong> <?= esc($user['pays_origine']) ?></p>

    </ul>

    <h2 class="mb-4 text-center">📅 Vos réservations en cours</h2>

    <?php if (!empty($reservations)) : ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary">
<tr>
    <th>
        Logement
        <a href="?sort=logement_nom&order=asc" title="Trier A-Z"><i class="fas fa-sort-alpha-down"></i></a>
        <a href="?sort=logement_nom&order=desc" title="Trier Z-A"><i class="fas fa-sort-alpha-up"></i></a>
    </th>
    <th>
        Date de réservation
        <a href="?sort=date_reservation&order=asc" title="Plus ancienne"><i class="fas fa-sort-numeric-down"></i></a>
        <a href="?sort=date_reservation&order=desc" title="Plus récente"><i class="fas fa-sort-numeric-up"></i></a>
    </th>
    <th>
        Date d'arrivée
        <a href="?sort=date_debut&order=asc" title="Arrivée croissante"><i class="fas fa-arrow-up-wide-short"></i></a>
        <a href="?sort=date_debut&order=desc" title="Arrivée décroissante"><i class="fas fa-arrow-down-short-wide"></i></a>
    </th>
    <th>
        Date de départ
        <a href="?sort=date_fin&order=asc" title="Départ croissant"><i class="fas fa-arrow-up-wide-short"></i></a>
        <a href="?sort=date_fin&order=desc" title="Départ décroissant"><i class="fas fa-arrow-down-short-wide"></i></a>
    </th>
    <th>Actions</th>
</tr>
</thead>



                <tbody>
                    <?php foreach ($reservations as $reservation) : ?>
                        <tr>
    <td><strong><?= esc($reservation['logement_nom']) ?></strong></td>
    <td><span class="badge bg-info"><?= date('d/m/Y', strtotime($reservation['date_reservation'])) ?></span></td>
    <td><span class="badge bg-success"><?= date('d/m/Y', strtotime($reservation['date_debut'])) ?></span></td>
    <td><span class="badge bg-danger"><?= date('d/m/Y', strtotime($reservation['date_fin'])) ?></span></td>
    <td>
    <form method="post" action="<?= base_url('reservation/annuler/' . $reservation['id_reservation']) ?>" onsubmit="return confirm('Confirmer l\'annulation de cette réservation ?');">
        <button type="submit" class="btn btn-outline-danger btn-sm">🗑️ Annuler</button>
    </form>
</td>

</tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info text-center">
            Vous n'avez pas encore réservé de séjour.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
