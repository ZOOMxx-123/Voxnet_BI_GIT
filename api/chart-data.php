<?php
header('Content-Type: application/json');
require_once '../includes/functions.php';

$pdo = getPdo();

// Données pour le graphique des statuts
$status_sql = "SELECT Status, COUNT(*) as count 
               FROM Table_Metier_Alpha 
               WHERE Status IS NOT NULL 
               GROUP BY Status";
$status_stmt = $pdo->query($status_sql);
$status_data = $status_stmt->fetchAll();

$status_labels = [];
$status_values = [];

foreach($status_data as $row) {
    $status_labels[] = $row['Status'];
    $status_values[] = $row['count'];
}

// Données pour le graphique des agents
$agents_sql = "SELECT 
                CONCAT(a.Prenom, ' ', a.Nom) as agent_name,
                COUNT(DISTINCT m.id_lead) as appels,
                SUM(CASE WHEN m.Status = 'Vente' THEN 1 ELSE 0 END) as ventes
               FROM agents a
               LEFT JOIN Table_Metier_Alpha m ON a.id_agent = m.agent_id
               GROUP BY a.id_agent, a.Prenom, a.Nom
               ORDER BY ventes DESC";
$agents_stmt = $pdo->query($agents_sql);
$agents_data = $agents_stmt->fetchAll();

$agents_labels = [];
$agents_appels = [];
$agents_ventes = [];

foreach($agents_data as $row) {
    $agents_labels[] = $row['agent_name'];
    $agents_appels[] = $row['appels'];
    $agents_ventes[] = $row['ventes'];
}

echo json_encode([
    'status' => [
        'labels' => $status_labels,
        'values' => $status_values
    ],
    'agents' => [
        'labels' => $agents_labels,
        'values' => $agents_appels,
        'appels' => $agents_appels,
        'ventes' => $agents_ventes
    ]
]);
?>