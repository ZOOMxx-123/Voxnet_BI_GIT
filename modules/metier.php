<?php
require_once '../includes/functions.php';
require_once '../includes/header.php';

$message = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'add':
                $data = [
                    'Nom' => $_POST['Nom'], // Contient nom + prénom ensemble
                    'TEL' => $_POST['TEL'],
                    'Status' => $_POST['Status'],
                    'agent_id' => !empty($_POST['agent_id']) ? $_POST['agent_id'] : null,
                    'dateappel' => !empty($_POST['dateappel']) ? $_POST['dateappel'] : null
                ];
                
                $pdo = getPdo();
                $sql = "INSERT INTO Table_Metier_Alpha (Nom, TEL, Status, agent_id, dateappel) 
                        VALUES (:Nom, :TEL, :Status, :agent_id, :dateappel)";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute($data)) {
                    $message = "Lead ajouté avec succès";
                } else {
                    $error = "Erreur lors de l'ajout du lead";
                }
                break;
                
            case 'edit':
                if (isset($_POST['id_lead'])) {
                    $data = [
                        'id_lead' => $_POST['id_lead'],
                        'Nom' => $_POST['Nom'],
                        'TEL' => $_POST['TEL'],
                        'Status' => $_POST['Status'],
                        'agent_id' => !empty($_POST['agent_id']) ? $_POST['agent_id'] : null,
                        'dateappel' => !empty($_POST['dateappel']) ? $_POST['dateappel'] : null
                    ];
                    
                    $pdo = getPdo();
                    $sql = "UPDATE Table_Metier_Alpha 
                            SET Nom = :Nom, 
                                TEL = :TEL, 
                                Status = :Status, 
                                agent_id = :agent_id, 
                                dateappel = :dateappel 
                            WHERE id_lead = :id_lead";
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute($data)) {
                        $message = "Lead modifié avec succès";
                    } else {
                        $error = "Erreur lors de la modification";
                    }
                }
                break;
                
            case 'delete':
                if (isset($_POST['id_lead'])) {
                    $pdo = getPdo();
                    $stmt = $pdo->prepare("DELETE FROM Table_Metier_Alpha WHERE id_lead = ?");
                    if ($stmt->execute([$_POST['id_lead']])) {
                        $message = "Lead supprimé avec succès";
                    } else {
                        $error = "Erreur lors de la suppression";
                    }
                }
                break;
                
            case 'bulk_delete':
                if (isset($_POST['selected_ids']) && !empty($_POST['selected_ids'])) {
                    $ids = implode(',', array_map('intval', $_POST['selected_ids']));
                    $pdo = getPdo();
                    $stmt = $pdo->prepare("DELETE FROM Table_Metier_Alpha WHERE id_lead IN ($ids)");
                    if ($stmt->execute()) {
                        $message = count($_POST['selected_ids']) . " leads supprimés avec succès";
                    } else {
                        $error = "Erreur lors de la suppression multiple";
                    }
                }
                break;
        }
    }
}

// Récupérer les filtres
$search = isset($_GET['search']) ? $_GET['search'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$agent = isset($_GET['agent']) ? $_GET['agent'] : '';

// Récupérer les données
$data = getTableMetier($search, $status, $agent);
$status_list = getDistinctStatus();
$agents = getAgents();
?>

<div class="row mb-4">
    <div class="col-12">
        <h2><i class="bi bi-database"></i> Gestion des Leads (Table_Metier_Alpha)</h2>
        <hr>
    </div>
</div>

<?php if($message): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill"></i> <?php echo $message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if($error): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i> <?php echo $error; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<!-- Filtres -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-funnel"></i> Filtres</h5>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Recherche (Nom/Tél)</label>
                        <input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($search); ?>" placeholder="Nom ou téléphone...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-control">
                            <option value="">Tous les statuts</option>
                            <?php foreach($status_list as $s): ?>
                            <option value="<?php echo htmlspecialchars($s); ?>" <?php echo $status == $s ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($s); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Agent</label>
                        <select name="agent" class="form-control">
                            <option value="">Tous les agents</option>
                            <?php foreach($agents as $a): ?>
                            <option value="<?php echo $a['id_agent']; ?>" <?php echo $agent == $a['id_agent'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($a['Prenom'] . ' ' . $a['Nom']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
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

<!-- Boutons d'action -->
<div class="row mb-4">
    <div class="col-12">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLeadModal">
            <i class="bi bi-plus-circle"></i> Ajouter un Lead
        </button>
        <button type="button" class="btn btn-danger" id="bulkDeleteBtn" disabled onclick="bulkDelete()">
            <i class="bi bi-trash"></i> Supprimer sélection
        </button>
        <button type="button" class="btn btn-success" onclick="exportToCSV()">
            <i class="bi bi-download"></i> Exporter CSV
        </button>
        <span class="float-end">
            <span class="badge bg-primary">Total: <?php echo count($data); ?> leads</span>
        </span>
    </div>
</div>

<!-- Tableau des leads -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list"></i> Liste des Leads</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="leadsTable">
                        <thead>
                            <tr>
                                <th width="30px">
                                    <input type="checkbox" id="selectAll" onclick="toggleAll(this)">
                                </th>
                                <th>ID</th>
                                <th>Nom complet</th>
                                <th>Téléphone</th>
                                <th>Statut</th>
                                <th>Agent</th>
                                <th>Date Appel</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $row): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="lead-select" value="<?php echo $row['id_lead']; ?>" onchange="toggleBulkDelete()">
                                </td>
                                <td><?php echo $row['id_lead']; ?></td>
                                <td><?php echo htmlspecialchars($row['Nom']); ?></td>
                                <td><?php echo htmlspecialchars($row['TEL']); ?></td>
                                <td>
                                    <?php 
                                    $badge_class = 'secondary';
                                    if($row['Status'] == 'Vente') $badge_class = 'success';
                                    elseif($row['Status'] == 'Refus') $badge_class = 'danger';
                                    elseif($row['Status'] == 'Rappel personnel') $badge_class = 'info';
                                    elseif($row['Status'] == 'Répondeur') $badge_class = 'warning';
                                    elseif($row['Status'] == 'Intéressé') $badge_class = 'primary';
                                    elseif($row['Status'] == 'A traiter') $badge_class = 'secondary';
                                    ?>
                                    <span class="badge bg-<?php echo $badge_class; ?>"><?php echo htmlspecialchars($row['Status']); ?></span>
                                </td>
                                <td>
                                    <?php 
                                    if($row['agent_id']) {
                                        echo htmlspecialchars($row['agent_prenom'] . ' ' . $row['agent_nom']);
                                    } else {
                                        echo '<span class="text-muted">Non assigné</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                    if($row['dateappel']) {
                                        echo date('d/m/Y H:i', strtotime($row['dateappel']));
                                    } else {
                                        echo '<span class="text-muted">-</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" onclick='editLead(<?php echo json_encode($row); ?>)' title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="viewCDR('<?php echo $row['TEL']; ?>')" title="Voir dans CDR">
                                        <i class="bi bi-telephone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteLead(<?php echo $row['id_lead']; ?>)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajouter -->
<div class="modal fade" id="addLeadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Ajouter un nouveau lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="mb-3">
                        <label class="form-label">Nom complet <span class="text-danger">*</span></label>
                        <input type="text" name="Nom" class="form-control" placeholder="Ex: Robert Lucas" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="TEL" class="form-control tel-input" pattern="[0-9]{10}" placeholder="0612345678" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="Status" class="form-control">
                            <option value="A traiter">A traiter</option>
                            <option value="Vente">Vente</option>
                            <option value="Refus">Refus</option>
                            <option value="Rappel personnel">Rappel personnel</option>
                            <option value="Répondeur">Répondeur</option>
                            <option value="Ne répond pas">Ne répond pas</option>
                            <option value="Intéressé">Intéressé</option>
                            <option value="Pas intéressé">Pas intéressé</option>
                            <option value="En cours">En cours</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Agent assigné</label>
                        <select name="agent_id" class="form-control">
                            <option value="">Non assigné</option>
                            <?php foreach($agents as $a): ?>
                            <option value="<?php echo $a['id_agent']; ?>">
                                <?php echo htmlspecialchars($a['Prenom'] . ' ' . $a['Nom'] . ' (' . $a['extension'] . ')'); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Date d'appel</label>
                        <input type="datetime-local" name="dateappel" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier -->
<div class="modal fade" id="editLeadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="bi bi-pencil"></i> Modifier le lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id_lead" id="edit_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Nom complet <span class="text-danger">*</span></label>
                        <input type="text" name="Nom" id="edit_nom" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="TEL" id="edit_tel" class="form-control tel-input" pattern="[0-9]{10}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="Status" id="edit_status" class="form-control">
                            <option value="A traiter">A traiter</option>
                            <option value="Vente">Vente</option>
                            <option value="Refus">Refus</option>
                            <option value="Rappel personnel">Rappel personnel</option>
                            <option value="Répondeur">Répondeur</option>
                            <option value="Ne répond pas">Ne répond pas</option>
                            <option value="Intéressé">Intéressé</option>
                            <option value="Pas intéressé">Pas intéressé</option>
                            <option value="En cours">En cours</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Agent assigné</label>
                        <select name="agent_id" id="edit_agent" class="form-control">
                            <option value="">Non assigné</option>
                            <?php foreach($agents as $a): ?>
                            <option value="<?php echo $a['id_agent']; ?>">
                                <?php echo htmlspecialchars($a['Prenom'] . ' ' . $a['Nom'] . ' (' . $a['extension'] . ')'); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Date d'appel</label>
                        <input type="datetime-local" name="dateappel" id="edit_date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-warning">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Supprimer -->
<div class="modal fade" id="deleteLeadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce lead ?</p>
                <p class="text-danger"><strong>Cette action est irréversible !</strong></p>
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_lead" id="delete_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Suppression multiple -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirmer la suppression multiple</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer les <span id="selectedCount"></span> leads sélectionnés ?</p>
                <p class="text-danger"><strong>Cette action est irréversible !</strong></p>
            </div>
            <div class="modal-footer">
                <form method="POST" id="bulkDeleteForm">
                    <input type="hidden" name="action" value="bulk_delete">
                    <div id="selectedIdsContainer"></div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer tout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let selectedLeads = new Set();

// Fonction pour éditer un lead
function editLead(lead) {
    document.getElementById('edit_id').value = lead.id_lead;
    document.getElementById('edit_nom').value = lead.Nom || '';
    document.getElementById('edit_tel').value = lead.TEL || '';
    document.getElementById('edit_status').value = lead.Status || 'A traiter';
    document.getElementById('edit_agent').value = lead.agent_id || '';
    
    if (lead.dateappel) {
        let date = new Date(lead.dateappel);
        let year = date.getFullYear();
        let month = String(date.getMonth() + 1).padStart(2, '0');
        let day = String(date.getDate()).padStart(2, '0');
        let hours = String(date.getHours()).padStart(2, '0');
        let minutes = String(date.getMinutes()).padStart(2, '0');
        document.getElementById('edit_date').value = `${year}-${month}-${day}T${hours}:${minutes}`;
    } else {
        document.getElementById('edit_date').value = '';
    }
    
    new bootstrap.Modal(document.getElementById('editLeadModal')).show();
}

// Fonction pour supprimer un lead
function deleteLead(id) {
    document.getElementById('delete_id').value = id;
    new bootstrap.Modal(document.getElementById('deleteLeadModal')).show();
}

// Fonction pour voir dans CDR
function viewCDR(tel) {
    window.location.href = 'cdr.php?search=' + encodeURIComponent(tel);
}

// Fonction pour toggle "select all"
function toggleAll(checkbox) {
    const checkboxes = document.querySelectorAll('.lead-select');
    selectedLeads.clear();
    checkboxes.forEach(cb => {
        cb.checked = checkbox.checked;
        if (checkbox.checked) {
            selectedLeads.add(cb.value);
        }
    });
    toggleBulkDelete();
}

// Gestionnaire d'événements pour les checkboxes
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.lead-select');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                selectedLeads.add(this.value);
            } else {
                selectedLeads.delete(this.value);
                document.getElementById('selectAll').checked = false;
            }
            toggleBulkDelete();
        });
    });
    
    // Validation du téléphone
    const telInputs = document.querySelectorAll('.tel-input');
    telInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
        });
    });
});

// Fonction pour activer/désactiver le bouton de suppression multiple
function toggleBulkDelete() {
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    if (bulkDeleteBtn) {
        bulkDeleteBtn.disabled = selectedLeads.size === 0;
    }
}

// Fonction pour la suppression multiple
function bulkDelete() {
    if (selectedLeads.size === 0) return;
    
    document.getElementById('selectedCount').textContent = selectedLeads.size;
    
    // Créer les inputs hidden pour chaque ID
    const container = document.getElementById('selectedIdsContainer');
    container.innerHTML = '';
    selectedLeads.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_ids[]';
        input.value = id;
        container.appendChild(input);
    });
    
    new bootstrap.Modal(document.getElementById('bulkDeleteModal')).show();
}

// Fonction pour exporter en CSV
function exportToCSV() {
    // Récupérer toutes les lignes du tableau
    const table = document.getElementById('leadsTable');
    const rows = table.querySelectorAll('tr');
    
    // Tableau pour stocker les données CSV
    const csvData = [];
    
    // Parcourir toutes les lignes
    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const rowData = [];
        
        // Si c'est l'en-tête (première ligne)
        if (i === 0) {
            const headers = row.querySelectorAll('th');
            for (let j = 1; j < headers.length; j++) { // Ignorer la colonne checkbox seulement
                let headerText = headers[j].innerText;
                headerText = headerText.replace(/"/g, '""');
                rowData.push(`"${headerText}"`);
            }
        } 
        // Si c'est une ligne de données
        else {
            const cells = row.querySelectorAll('td');
            if (cells.length > 0) {
                for (let j = 1; j < cells.length; j++) { // Ignorer la colonne checkbox seulement
                    let cellText = cells[j].innerText.trim();
                    // Nettoyer le texte
                    cellText = cellText.replace(/\n/g, ' ').replace(/\r/g, '');
                    // Échapper les guillemets
                    cellText = cellText.replace(/"/g, '""');
                    rowData.push(`"${cellText}"`);
                }
            }
        }
        
        // Ajouter la ligne au CSV si elle n'est pas vide
        if (rowData.length > 0) {
            csvData.push(rowData.join(','));
        }
    }
    
    // Créer le contenu CSV
    const csvContent = csvData.join('\n');
    
    // Créer un blob et télécharger
    const blob = new Blob(["\uFEFF" + csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    
    // Générer un nom de fichier avec la date
    const today = new Date();
    const dateStr = today.toISOString().slice(0, 10);
    
    link.href = url;
    link.setAttribute('download', 'leads_export_' + dateStr + '.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
    
    // Message de confirmation
    alert('Export CSV terminé ! ' + (csvData.length - 1) + ' lignes exportées.');
}
</script>

<?php require_once '../includes/footer.php'; ?>