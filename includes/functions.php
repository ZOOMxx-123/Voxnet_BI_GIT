<?php
require_once __DIR__ . '/../config/database.php';

function getPdo() {
    $db = new Database();
    return $db->connect();
}

function getReconciledData($campagne = null) {
    $pdo = getPdo();
    
    $sql = "SELECT 
                m.id_lead,
                m.Nom as client_nom,
                m.TEL,
                m.Status as metier_status,
                m.dateappel,
                a.id_agent,
                a.Nom as agent_nom,
                a.Prenom as agent_prenom,
                a.extension,
                c.calldate,
                c.duration,
                c.billsec,
                c.disposition as tech_status,
                TIMESTAMPDIFF(SECOND, m.dateappel, c.calldate) as time_diff
            FROM Table_Metier_Alpha m
            LEFT JOIN agents a ON m.agent_id = a.id_agent
            LEFT JOIN cdr c ON c.src = a.extension 
                AND c.dst = m.TEL
                AND ABS(TIMESTAMPDIFF(SECOND, m.dateappel, c.calldate)) < 300";
    
    if ($campagne) {
        $sql .= " WHERE m.campagne = :campagne";
    }
    
    $sql .= " ORDER BY m.dateappel DESC";
    
    $stmt = $pdo->prepare($sql);
    if ($campagne) {
        $stmt->execute(['campagne' => $campagne]);
    } else {
        $stmt->execute();
    }
    
    return $stmt->fetchAll();
}

function getStatsCampagne() {
    $pdo = getPdo();
    
    $sql = "SELECT 
                'Prospection Alpha' as campagne,
                COUNT(DISTINCT m.id_lead) as total_appels,
                SUM(CASE WHEN m.Status = 'Vente' THEN 1 ELSE 0 END) as total_ventes,
                AVG(CASE WHEN m.Status = 'Vente' AND c.billsec > 0 THEN c.billsec ELSE NULL END) as dmt_ventes,
                COUNT(CASE WHEN m.dateappel IS NOT NULL THEN 1 END) as fiches_traitees,
                (SELECT COUNT(*) FROM Table_Metier_Alpha) as fiches_total,
                AVG(c.billsec) as dmt_global
            FROM Table_Metier_Alpha m
            LEFT JOIN agents a ON m.agent_id = a.id_agent
            LEFT JOIN cdr c ON c.src = a.extension AND c.dst = m.TEL";
            
    $stmt = $pdo->query($sql);
    return $stmt->fetch();
}

function getStatsAgents() {
    $pdo = getPdo();
    
    $sql = "SELECT 
                a.id_agent,
                a.Nom,
                a.Prenom,
                a.extension,
                COUNT(DISTINCT m.id_lead) as nb_appels,
                SUM(CASE WHEN m.Status = 'Vente' THEN 1 ELSE 0 END) as nb_ventes,
                SUM(c.billsec) as temps_total,
                AVG(c.billsec) as dmt_moyen,
                ROUND((SUM(CASE WHEN m.Status = 'Vente' THEN 1 ELSE 0 END) / COUNT(DISTINCT m.id_lead)) * 100, 2) as taux_reussite,
                COUNT(CASE WHEN c.disposition = 'ANSWERED' THEN 1 END) as appels_decroches,
                COUNT(CASE WHEN c.disposition IN ('NO ANSWER', 'BUSY') THEN 1 END) as appels_manques
            FROM agents a
            LEFT JOIN Table_Metier_Alpha m ON a.id_agent = m.agent_id
            LEFT JOIN cdr c ON c.src = a.extension AND c.dst = m.TEL
            GROUP BY a.id_agent, a.Nom, a.Prenom, a.extension
            ORDER BY nb_ventes DESC";
            
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function getAgents() {
    $pdo = getPdo();
    $stmt = $pdo->query("SELECT * FROM agents ORDER BY Nom, Prenom");
    return $stmt->fetchAll();
}

function getAgentById($id) {
    $pdo = getPdo();
    $stmt = $pdo->prepare("SELECT * FROM agents WHERE id_agent = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function addAgent($data) {
    $pdo = getPdo();
    $sql = "INSERT INTO agents (Nom, Prenom, extension, Email, Password, active) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $data['Nom'],
        $data['Prenom'],
        $data['extension'],
        $data['Email'],
        password_hash($data['Password'], PASSWORD_DEFAULT),
        $data['active']
    ]);
}

function updateAgent($id, $data) {
    $pdo = getPdo();
    $sql = "UPDATE agents SET Nom=?, Prenom=?, extension=?, Email=?, active=? WHERE id_agent=?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $data['Nom'],
        $data['Prenom'],
        $data['extension'],
        $data['Email'],
        $data['active'],
        $id
    ]);
}

function deleteAgent($id) {
    $pdo = getPdo();
    $stmt = $pdo->prepare("DELETE FROM agents WHERE id_agent = ?");
    return $stmt->execute([$id]);
}

function getCampagnes() {
    $pdo = getPdo();
    $stmt = $pdo->query("SELECT * FROM campagne WHERE active='Oui' ORDER BY nom");
    return $stmt->fetchAll();
}

function getTableMetier($search = '', $status = '', $agent = '') {
    $pdo = getPdo();
    $sql = "SELECT m.*, a.Nom as agent_nom, a.Prenom as agent_prenom 
            FROM Table_Metier_Alpha m
            LEFT JOIN agents a ON m.agent_id = a.id_agent
            WHERE 1=1";
    $params = [];
    
    if (!empty($search)) {
        $sql .= " AND (m.Nom LIKE ? OR m.TEL LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    
    if (!empty($status)) {
        $sql .= " AND m.Status = ?";
        $params[] = $status;
    }
    
    if (!empty($agent)) {
        $sql .= " AND m.agent_id = ?";
        $params[] = $agent;
    }
    
    $sql .= " ORDER BY m.id_lead";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getCDR($search = '', $disposition = '') {
    $pdo = getPdo();
    $sql = "SELECT c.*, a.Nom, a.Prenom 
            FROM cdr c
            LEFT JOIN agents a ON c.src = a.extension
            WHERE 1=1";
    $params = [];
    
    if (!empty($search)) {
        $sql .= " AND (c.src LIKE ? OR c.dst LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    
    if (!empty($disposition)) {
        $sql .= " AND c.disposition = ?";
        $params[] = $disposition;
    }
    
    $sql .= " ORDER BY c.calldate DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getDistinctStatus() {
    $pdo = getPdo();
    $stmt = $pdo->query("SELECT DISTINCT Status FROM Table_Metier_Alpha WHERE Status IS NOT NULL ORDER BY Status");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getDistinctDisposition() {
    $pdo = getPdo();
    $stmt = $pdo->query("SELECT DISTINCT disposition FROM cdr ORDER BY disposition");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>