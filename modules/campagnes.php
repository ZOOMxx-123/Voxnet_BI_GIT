<?php
require_once '../includes/functions.php';
require_once '../includes/header.php';

$campagnes = getCampagnes();
?>

<div class="row mb-4">
    <div class="col-12">
        <h2><i class="bi bi-megaphone"></i> Campagnes Actives</h2>
        <hr>
    </div>
</div>

<div class="row">
    <?php foreach($campagnes as $campagne): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-megaphone-fill"></i> <?php echo $campagne['nom']; ?></h5>
            </div>
            <div class="card-body">
                <p><strong>Table associée:</strong> <code><?php echo $campagne['tabmysql']; ?></code></p>
                <p><strong>Statut:</strong> <span class="badge bg-success">Active</span></p>
                
                <?php
                // Compter les enregistrements dans la table métier
                $pdo = getPdo();
                $stmt = $pdo->query("SELECT COUNT(*) as total FROM " . $campagne['tabmysql']);
                $total = $stmt->fetch()['total'];
                
                $stmt = $pdo->query("SELECT COUNT(*) as traite FROM " . $campagne['tabmysql'] . " WHERE dateappel IS NOT NULL");
                $traite = $stmt->fetch()['traite'];
                ?>
                
                <div class="mt-3">
                    <p><strong>Progression:</strong></p>
                    <div class="progress mb-2" style="height: 20px;">
                        <div class="progress-bar bg-success" style="width: <?php echo ($traite/$total)*100; ?>%">
                            <?php echo round(($traite/$total)*100, 1); ?>%
                        </div>
                    </div>
                    <small><?php echo $traite; ?>/<?php echo $total; ?> fiches traitées</small>
                </div>
            </div>
            <div class="card-footer">
                <a href="metier.php?table=<?php echo $campagne['tabmysql']; ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-eye"></i> Voir les données
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once '../includes/footer.php'; ?>