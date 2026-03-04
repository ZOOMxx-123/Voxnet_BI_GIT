<?php
require_once 'includes/functions.php';
require_once 'includes/header.php';

$stats_campagne = getStatsCampagne();
$stats_agents = getStatsAgents();
$reconciled_data = getReconciledData();
?>

<div class="row mb-4">
    <div class="col-12">
        <h2><i class="bi bi-speedometer2"></i> Dashboard de Performance</h2>
        <hr>
    </div>
</div>

<!-- Cartes Statistiques -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-telephone"></i> Total Appels</h5>
                <h2><?php echo $stats_campagne['total_appels']; ?></h2>
                <small>Fiches traitées: <?php echo $stats_campagne['fiches_traitees']; ?>/<?php echo $stats_campagne['fiches_total']; ?></small>
                <div class="progress mt-2" style="height: 5px;">
                    <div class="progress-bar bg-light" style="width: <?php echo ($stats_campagne['fiches_traitees']/$stats_campagne['fiches_total'])*100; ?>%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-graph-up"></i> Taux Transformation</h5>
                <h2><?php echo round(($stats_campagne['total_ventes']/$stats_campagne['total_appels'])*100, 1); ?>%</h2>
                <small><?php echo $stats_campagne['total_ventes']; ?> ventes / <?php echo $stats_campagne['total_appels']; ?> appels</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-clock"></i> DMT Global</h5>
                <h2><?php echo round($stats_campagne['dmt_global']/60, 1); ?> min</h2>
                <small><?php echo round($stats_campagne['dmt_global'], 0); ?> secondes</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-trophy"></i> DMT Ventes</h5>
                <h2><?php echo round($stats_campagne['dmt_ventes']/60, 1); ?> min</h2>
                <small><?php echo round($stats_campagne['dmt_ventes'], 0); ?> secondes</small>
            </div>
        </div>
    </div>
</div>

<!-- Graphiques -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Répartition des Statuts</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Performance par Agent</h5>
            </div>
            <div class="card-body">
                <canvas id="agentChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Classement Agents -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-trophy"></i> Classement des Agents</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Agent</th>
                                <th>Extension</th>
                                <th>Appels</th>
                                <th>Ventes</th>
                                <th>Taux Réussite</th>
                                <th>Temps Total</th>
                                <th>DMT Moyen</th>
                                <th>Décrochés</th>
                                <th>Manqués</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($stats_agents as $agent): ?>
                            <tr>
                                <td><strong><?php echo $agent['Prenom'] . ' ' . $agent['Nom']; ?></strong></td>
                                <td><?php echo $agent['extension']; ?></td>
                                <td><?php echo $agent['nb_appels']; ?></td>
                                <td><span class="badge bg-success"><?php echo $agent['nb_ventes']; ?></span></td>
                                <td><?php echo $agent['taux_reussite']; ?>%</td>
                                <td><?php echo gmdate("H:i:s", $agent['temps_total']); ?></td>
                                <td><?php echo round($agent['dmt_moyen'], 0); ?>s</td>
                                <td><?php echo $agent['appels_decroches']; ?></td>
                                <td><?php echo $agent['appels_manques']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Données Réconciliées -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="bi bi-diagram-3"></i> Données Réconciliées (Métier + Technique)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Téléphone</th>
                                <th>Agent</th>
                                <th>Statut Métier</th>
                                <th>Date Appel</th>
                                <th>Statut Technique</th>
                                <th>Durée (s)</th>
                                <th>Écart (s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($reconciled_data as $row): ?>
                            <tr>
                                <td><?php echo $row['client_nom']; ?></td>
                                <td><?php echo $row['TEL']; ?></td>
                                <td><?php echo $row['agent_prenom'] . ' ' . $row['agent_nom']; ?></td>
                                <td>
                                    <?php 
                                    $badge_class = 'secondary';
                                    if($row['metier_status'] == 'Vente') $badge_class = 'success';
                                    elseif($row['metier_status'] == 'Refus') $badge_class = 'danger';
                                    elseif($row['metier_status'] == 'Rappel personnel') $badge_class = 'info';
                                    ?>
                                    <span class="badge bg-<?php echo $badge_class; ?>"><?php echo $row['metier_status']; ?></span>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($row['dateappel'])); ?></td>
                                <td>
                                    <?php 
                                    $badge_class = 'secondary';
                                    if($row['tech_status'] == 'ANSWERED') $badge_class = 'success';
                                    elseif($row['tech_status'] == 'NO ANSWER') $badge_class = 'warning';
                                    elseif($row['tech_status'] == 'BUSY') $badge_class = 'danger';
                                    ?>
                                    <span class="badge bg-<?php echo $badge_class; ?>"><?php echo $row['tech_status']; ?></span>
                                </td>
                                <td><?php echo $row['billsec']; ?></td>
                                <td><?php echo $row['time_diff']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Graphiques
fetch('/voxnet_bi/api/chart-data.php')
    .then(response => response.json())
    .then(data => {
        // Graphique des statuts
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: data.status.labels,
                datasets: [{
                    data: data.status.values,
                    backgroundColor: ['#28a745', '#ffc107', '#17a2b8', '#dc3545', '#6c757d']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Graphique des agents
        new Chart(document.getElementById('agentChart'), {
            type: 'bar',
            data: {
                labels: data.agents.labels,
                datasets: [{
                    label: 'Ventes',
                    data: data.agents.ventes,
                    backgroundColor: '#28a745'
                }, {
                    label: 'Appels',
                    data: data.agents.appels,
                    backgroundColor: '#17a2b8'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<?php require_once 'includes/footer.php'; ?>                