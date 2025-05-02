<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>DevlaRoom - Réserver un séjour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            margin-top: 60px;
        }

        .form-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .logements-section {
            margin-top: 60px;
        }

        .logement-card img {
            height: 180px;
            object-fit: cover;
        }

        .logement-card {
            transition: transform 0.3s ease;
        }

        .logement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }

        .card-body {
    padding: 1.5rem;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 600;
}

.btn-outline-success {
    background-color: white;
    transition: all 0.3s ease-in-out;
}

.btn-outline-success:hover {
    background-color: #28a745;
    color: white;
}
.container.mt-5 {
    margin-top: 100px;
}


        .badge {
            font-size: 0.9em;
        }

        .btn-search {
            background: linear-gradient(45deg, #ffcc00, #ffaa00);
            color: #000;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 30px;
            border: none;
            transition: 0.3s;
        }

        .btn-search:hover {
            transform: scale(1.05);
            background: linear-gradient(45deg, #ffaa00, #ffcc00);
        }
    </style>
</head>

<!-- ... HEAD identique à ta version ... -->

<body>
<?= view('templates/navbar'); ?>

<div class="container mt-5">
    <div class="overlay form-container">
        <h2 class="text-center mb-4"><i class="bi bi-door-open-fill text-warning"></i> DevlaRoom – Réserver votre séjour</h2>
        <form method="post" action="<?= base_url('reservation/recherche') ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="date_debut" class="form-label">Date d'arrivée</label>
                    <input type="date" name="date_debut" value="<?= esc($date_debut ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label for="date_fin" class="form-label">Date de départ</label>
                    <input type="date" name="date_fin" value="<?= esc($date_fin ?? '') ?>">

                </div>
                <div class="col-md-6">
                    <label for="capacite_min" class="form-label">Capacité minimale</label>
                    <input type="number" name="capacite_min" value="<?= esc($capacite_min ?? '') ?>">

                </div>
                <div class="col-md-6">
                    <label for="type_logement" class="form-label">Type de logement</label>
                    <select name="type_logement" id="type_logement" class="form-select">
                        <option value="">Tous les types</option>
                        <option value="chambre" <?= ($type_logement ?? '') === 'chambre' ? 'selected' : '' ?>>Chambre</option>
<option value="appartement" <?= ($type_logement ?? '') === 'appartement' ? 'selected' : '' ?>>Appartement</option>
<option value="studio" <?= ($type_logement ?? '') === 'studio' ? 'selected' : '' ?>>Studio</option>

                    </select>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-search"><i class="bi bi-search"></i> Rechercher des hébergements</button>
            </div>
        </form>
    </div>

    <?php if (!empty($logements_disponibles)) : ?>
        <div class="logements-section">
            <h4 class="text-center mt-5 mb-4"><i class="bi bi-building-check"></i> Logements disponibles</h4>
            <div class="row">
                <?php
                function getImageForType($type) {
                    $type = strtolower(trim($type));
                    if (str_contains($type, 'chambre')) return 'https://source.unsplash.com/400x250/?bedroom,cozy';
                    if (str_contains($type, 'appartement')) return 'https://source.unsplash.com/400x250/?apartment,modern';
                    if (str_contains($type, 'studio')) return 'https://source.unsplash.com/400x250/?studio,interior';
                    return 'https://source.unsplash.com/400x250/?hotel';
                }
                $date_debut = esc(set_value('date_debut') ?: ($_POST['date_debut'] ?? ''));
                $date_fin = esc(set_value('date_fin') ?: ($_POST['date_fin'] ?? ''));
                ?>
                <?php foreach ($logements_disponibles as $logement): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow h-100 border-0 logement-card">
                            <img src="<?= getImageForType($logement['type']) ?>" class="card-img-top" alt="Image logement">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title"><?= esc($logement['nom']) ?></h5>
                                <p>
                                    <span class="badge bg-dark"><i class="bi bi-person-fill"></i> <?= esc($logement['capacite']) ?> pers.</span>
                                    <span class="badge bg-info text-dark"><i class="bi bi-house-fill"></i> <?= esc($logement['type']) ?></span>
                                </p>

                                <form method="post" action="<?= base_url('reservation/confirmer') ?>" class="mt-2">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_logement" value="<?= esc($logement['id_logement']) ?>">
                                    <input type="hidden" name="date_debut" value="<?= esc($date_debut ?? '') ?>">
<input type="hidden" name="date_fin" value="<?= esc($date_fin ?? '') ?>">

                                    <button type="submit" class="btn btn-outline-success w-100 rounded-pill">
                                        Réserver ce logement
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="alert alert-info text-center mt-5">Aucun logement disponible pour les critères sélectionnés.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
