<?php
require_once '../includes/functions.php';
require_once '../includes/header.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$disposition = isset($_GET['disposition']) ? $_GET['disposition'] : '';
$tel = isset($_GET['tel']) ? $_GET['tel'] : '';

if ($tel) {
    $search = $tel;
}

$data = getCDR($search, $disposition);
$dispositions = getDistinctDisposition();
?>

<div class="row mb-4">
    <div class="col-12">
        <h2><i class="bi bi-telephone"></i> Logs CDR (Asterisk)</h2>
        <hr>
    </div>
</div>

<!-- Filtres -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-funnel"></i> Filtres</h5>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Recherche (Source/Destination)</label>
                        <input type="text" name="search" class="form-control" value="<?php echo $search; ?>" placeholder="Extension ou téléphone...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Disposition</label>
                        <select name="disposition" class="form-control">
                            <option value="">Tous</option>
                            <?php foreach($dispositions as $d): ?>
                            <option value="<?php echo $d; ?>" <?php echo $disposition == $d ? 'selected' : ''; ?>>
                                <?php echo $d; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-info form-control">
                            <i class="bi bi-search"></i> Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tableau CDR -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Détails des Appels (<?php echo count($data); ?> enregistrements)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Source (Agent)</th>
                                <th>Destination</th>
                                <th>Durée</th>
                                <th>Durée fact.</th>
                                <th>Disposition</th>
                                <th>Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $row): ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($row['calldate'])); ?></td>
                                <td><?php echo $row['src']; ?></td>
                                <td><?php echo $row['dst']; ?></td>
                                <td><?php echo gmdate("H:i:s", $row['duration']); ?></td>
                                <td><?php echo gmdate("H:i:s", $row['billsec']); ?></td>
                                <td>
                                    <?php 
                                    $badge_class = 'secondary';
                                    if($row['disposition'] == 'ANSWERED') $badge_class = 'success';
                                    elseif($row['disposition'] == 'NO ANSWER') $badge_class = 'warning';
                                    elseif($row['disposition'] == 'BUSY') $badge_class = 'danger';
                                    ?>
                                    <span class="badge bg-<?php echo $badge_class; ?>"><?php echo $row['disposition']; ?></span>
                                </td>
                                <td><?php echo $row['Nom'] ? $row['Prenom'] . ' ' . $row['Nom'] : '-'; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>