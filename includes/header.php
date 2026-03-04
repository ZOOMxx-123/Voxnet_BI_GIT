<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voxnet - Plateforme BI</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom CSS -->
    <link href="/voxnet_bi/assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/voxnet_bi/index.php">
            <img src="/voxnet_bi/assets/images/logo-voxnet.png" 
                alt="Voxnet" 
                height="30" 
                class="d-inline-block align-text-top me-2"> 
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" 
                       href="/voxnet_bi/index.php">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'agents.php' ? 'active' : ''; ?>" 
                       href="/voxnet_bi/modules/agents.php">
                        <i class="bi bi-people"></i> Agents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'campagnes.php' ? 'active' : ''; ?>" 
                       href="/voxnet_bi/modules/campagnes.php">
                        <i class="bi bi-megaphone"></i> Campagnes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'metier.php' ? 'active' : ''; ?>" 
                       href="/voxnet_bi/modules/metier.php">
                        <i class="bi bi-database"></i> Données Métier
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'cdr.php' ? 'active' : ''; ?>" 
                       href="/voxnet_bi/modules/cdr.php">
                        <i class="bi bi-telephone"></i> Logs CDR
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">