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
                    'Nom' => $_POST['Nom'],
                    'Prenom' => $_POST['Prenom'],
                    'extension' => $_POST['extension'],
                    'Email' => $_POST['Email'],
                    'Password' => $_POST['Password'],
                    'active' => $_POST['active']
                ];
                if (addAgent($data)) {
                    $message = "Agent ajouté avec succès";
                } else {
                    $error = "Erreur lors de l'ajout";
                }
                break;
                
            case 'edit':
                if (isset($_POST['id_agent'])) {
                    $data = [
                        'Nom' => $_POST['Nom'],
                        'Prenom' => $_POST['Prenom'],
                        'extension' => $_POST['extension'],
                        'Email' => $_POST['Email'],
                        'active' => $_POST['active']
                    ];
                    if (updateAgent($_POST['id_agent'], $data)) {
                        $message = "Agent modifié avec succès";
                    } else {
                        $error = "Erreur lors de la modification";
                    }
                }
                break;
                
            case 'delete':
                if (isset($_POST['id_agent'])) {
                    if (deleteAgent($_POST['id_agent'])) {
                        $message = "Agent supprimé avec succès";
                    } else {
                        $error = "Erreur lors de la suppression";
                    }
                }
                break;
        }
    }
}

$agents = getAgents();
?>

<div class="row mb-4">
    <div class="col-12">
        <h2><i class="bi bi-people"></i> Gestion des Agents</h2>
        <hr>
    </div>
</div>

<?php if($message): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if($error): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo $error; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row mb-4">
    <div class="col-12">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAgentModal">
            <i class="bi bi-plus-circle"></i> Ajouter un Agent
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Liste des Agents</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Extension</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($agents as $agent): ?>
                            <tr>
                                <td><?php echo $agent['id_agent']; ?></td>
                                <td><?php echo $agent['Nom']; ?></td>
                                <td><?php echo $agent['Prenom']; ?></td>
                                <td><?php echo $agent['extension']; ?></td>
                                <td><?php echo $agent['Email']; ?></td>
                                <td>
                                    <?php if($agent['active'] == '1'): ?>
                                        <span class="badge bg-success">Actif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" onclick="editAgent(<?php echo htmlspecialchars(json_encode($agent)); ?>)">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteAgent(<?php echo $agent['id_agent']; ?>)">
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

<!-- Add Modal -->
<div class="modal fade" id="addAgentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Ajouter un Agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="Nom" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="Prenom" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Extension SIP</label>
                        <input type="text" name="extension" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="Email" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="Password" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="active" class="form-control">
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
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

<!-- Edit Modal -->
<div class="modal fade" id="editAgentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Modifier l'Agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id_agent" id="edit_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="Nom" id="edit_nom" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="Prenom" id="edit_prenom" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Extension SIP</label>
                        <input type="text" name="extension" id="edit_extension" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="Email" id="edit_email" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="active" id="edit_active" class="form-control">
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteAgentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet agent ?
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_agent" id="delete_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function editAgent(agent) {
    document.getElementById('edit_id').value = agent.id_agent;
    document.getElementById('edit_nom').value = agent.Nom;
    document.getElementById('edit_prenom').value = agent.Prenom;
    document.getElementById('edit_extension').value = agent.extension;
    document.getElementById('edit_email').value = agent.Email;
    document.getElementById('edit_active').value = agent.active;
    
    new bootstrap.Modal(document.getElementById('editAgentModal')).show();
}

function deleteAgent(id) {
    document.getElementById('delete_id').value = id;
    new bootstrap.Modal(document.getElementById('deleteAgentModal')).show();
}
</script>

<?php require_once '../includes/footer.php'; ?>