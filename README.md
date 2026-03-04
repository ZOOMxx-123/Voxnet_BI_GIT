# 📊 Voxnet BI - Plateforme de Business Intelligence pour Centre d'Appel


## 🎯 Présentation

**Voxnet BI** est une application web de Business Intelligence conçue pour les centres d'appel. Elle permet de piloter l'activité en temps réel grâce à :

- **La gestion complète des agents** (ajout, modification, activation/désactivation)
- **La visualisation des campagnes actives**
- **La génération de statistiques précises** en croisant les données métier et techniques
- **Un dashboard interactif** avec graphiques et indicateurs de performance

## 📸 Captures d'écran

<div align="center">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(1).png" width="45%">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(2).png" width="45%">
</div>

<div align="center">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(3).png" width="45%">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(4).png" width="45%">
</div>

<div align="center">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(5).png" width="45%">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(6).png" width="45%">
</div>

<div align="center">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(7).png" width="45%">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(8).png" width="45%">
</div>

<div align="center">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(9).png" width="45%">
  <img src="screenshots/Capture%20d%27écran%20ZOOMxx%20(10).png" width="45%">
</div>

### 🔍 Problématique résolue
Le projet répond au besoin de **réconciliation** entre :
- **Données Métier** : Résultats des appels (Ventes, Rappels, Refus) stockés dans des tables dynamiques
- **Données Techniques** : Logs de communication (durée, statut technique) issus du serveur Asterisk

## ✨ Fonctionnalités

### 🖥️ Dashboard
- ✅ **4 indicateurs clés** (KPI) en temps réel
- ✅ **Graphiques interactifs** (Chart.js) : répartition des statuts, performance par agent
- ✅ **Classement des agents** avec leurs performances
- ✅ **Données réconciliées** (métier + technique)

### 👥 Gestion des Agents (CRUD)
- ✅ **Ajouter** un agent
- ✅ **Modifier** un agent
- ✅ **Supprimer** un agent (individuel ou multiple)
- ✅ **Activer/Désactiver** un agent

### 📞 Gestion des Leads (CRUD)
- ✅ **Ajouter** un lead
- ✅ **Modifier** un lead
- ✅ **Supprimer** un lead (individuel ou multiple)
- ✅ **Filtres avancés** (par statut, agent, recherche)
- ✅ **Export CSV** des données

### 📈 Campagnes
- ✅ **Liste des campagnes actives**
- ✅ **Visualisation** de la progression
- ✅ **Détail** des tables associées

### 📊 Logs CDR
- ✅ **Visualisation** des appels techniques
- ✅ **Filtres** par disposition (ANSWERED, NO ANSWER, BUSY)
- ✅ **Recherche** par numéro ou extension

## 📸 Captures d'écran

### Dashboard Principal
```
[Capture d'écran du dashboard à ajouter]
```

### Gestion des Agents
```
[Capture d'écran de la gestion des agents à ajouter]
```

### Données Métier
```
[Capture d'écran des leads à ajouter]
```

## 🛠 Technologies utilisées

### Backend
| Technologie | Version | Utilisation |
|-------------|---------|-------------|
| **PHP** | 7.4+ | Logique métier, requêtes BDD |
| **MySQL** | 5.7+ | Base de données |
| **PDO** | - | Connexion sécurisée à la BDD |

### Frontend
| Technologie | Version | Utilisation |
|-------------|---------|-------------|
| **HTML5** | - | Structure des pages |
| **CSS3** | - | Styles personnalisés |
| **Bootstrap** | 5.3 | Design responsive, composants |
| **Bootstrap Icons** | 1.11 | Icônes |
| **JavaScript** | ES6 | Interactions dynamiques |
| **jQuery** | 3.7 | DOM manipulation |
| **Chart.js** | 4.4 | Graphiques |
| **DataTables** | 1.13 | Tableaux interactifs |

### Environnement
- **Serveur** : Apache (via WAMP/XAMPP)
- **Base de données** : phpMyAdmin
- **Éditeur** : VS Code / Tout éditeur PHP

## 💻 Installation

### Prérequis
- WAMP / XAMPP / MAMP installé
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Navigateur web moderne

### Étapes d'installation

1. **Cloner le dépôt**
```bash
git clone https://github.com/votre-username/voxnet-bi.git
```

2. **Déplacer dans le dossier du serveur**
```bash
# Pour WAMP : C:\wamp64\www\
# Pour XAMPP : C:\xampp\htdocs\
cp -r voxnet-bi /chemin/vers/www/
```

3. **Créer la base de données**
- Ouvrez phpMyAdmin : http://localhost/phpmyadmin
- Importez le fichier `database.sql` (fourni dans le projet)

4. **Configurer la connexion**
- Modifiez le fichier `config/database.php` avec vos paramètres :
```php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306'); // ou 3307 selon votre configuration
define('DB_NAME', 'Voxnet');
define('DB_USER', 'root');
define('DB_PASS', ''); // mot de passe si nécessaire
```

5. **Lancer l'application**
- Ouvrez votre navigateur
- Accédez à : http://localhost/voxnet-bi/

## ⚙️ Configuration

### Fichier de configuration
Le fichier `config/database.php` contient les paramètres de connexion :

```php
<?php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3307');
define('DB_NAME', 'Voxnet');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### Personnalisation
- **Logo** : Placez votre logo dans `assets/images/logo-voxnet.png`
- **Favicon** : Remplacez `assets/images/favicon.ico`
- **Styles** : Modifiez `assets/css/style.css`
- **Scripts** : Modifiez `assets/js/scripts.js`

## 📁 Structure du projet

```
voxnet-bi/
├── index.php                    # Dashboard principal
├── README.md                    # Documentation
├── database.sql                  # Script de base de données
├── config/
│   └── database.php             # Configuration BDD
├── includes/
│   ├── header.php               # En-tête + menu
│   ├── footer.php               # Pied de page + scripts
│   └── functions.php            # Toutes les fonctions PHP
├── modules/
│   ├── agents.php               # CRUD agents
│   ├── campagnes.php            # Liste campagnes
│   ├── metier.php               # CRUD leads
│   └── cdr.php                  # Logs techniques
├── api/
│   └── chart-data.php           # API pour graphiques
└── assets/
    ├── images/                  # Images, logos
    ├── css/
    │   └── style.css            # Styles personnalisés
    └── js/
        └── scripts.js            # JavaScript personnalisé
```

## 🗄️ Base de données

### Structure

```sql
-- =====================================================
-- SCRIPT SQL VOXNET - VERSION MOYENNE
-- 10 AGENTS | 100 LEADS | 100 CDR
-- =====================================================

DROP DATABASE IF EXISTS ZOOMxx;
CREATE DATABASE ZOOMxx;
USE ZOOMxx;

-- =====================================================
-- 1. STRUCTURE DES TABLES
-- =====================================================

-- Table de pilotage (Campagnes actives)
CREATE TABLE `campagne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `tabmysql` varchar(60) NOT NULL,
  `active` enum('Oui','Non') NOT NULL DEFAULT 'Oui',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table des Agents
CREATE TABLE `agents` (
  `id_agent` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(60) DEFAULT NULL,
  `Prenom` varchar(60) DEFAULT NULL,
  `extension` varchar(10) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` text NOT NULL,
  `active` tinytext NOT NULL,
  PRIMARY KEY (`id_agent`),
  UNIQUE KEY `extension_unique` (`extension`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table Métier
CREATE TABLE `Table_Metier_Alpha` (
  `id_lead` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(60) DEFAULT NULL,
  `Prenom` varchar(60) DEFAULT NULL,
  `TEL` varchar(60) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `dateappel` datetime DEFAULT NULL,
  PRIMARY KEY (`id_lead`),
  KEY `idx_agent` (`agent_id`),
  KEY `idx_tel` (`TEL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table CDR (Logs Asterisk)
CREATE TABLE `cdr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calldate` datetime NOT NULL,
  `src` varchar(80) NOT NULL,
  `dst` varchar(80) NOT NULL,
  `duration` int(11) NOT NULL,
  `billsec` int(11) NOT NULL,
  `disposition` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `src` (`src`),
  KEY `dst` (`dst`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- =====================================================
-- 2. INSERTION DES 10 AGENTS
-- =====================================================
TRUNCATE TABLE agents;

INSERT INTO `agents` (`id_agent`, `Nom`, `Prenom`, `extension`, `Email`, `Password`, `active`) VALUES 
(1, 'Alami', 'Ahmed', '1001', 'ahmed.alami@voxnet.ma', 'password123', '1'),
(2, 'Benani', 'Siham', '1002', 'siham.benani@voxnet.ma', 'password123', '1'),
(3, 'Idrissi', 'Omar', '1003', 'omar.idrissi@voxnet.ma', 'password123', '1'),
(4, 'Tazi', 'Nadia', '1004', 'nadia.tazi@voxnet.ma', 'password123', '1'),
(5, 'Fassi', 'Youssef', '1005', 'youssef.fassi@voxnet.ma', 'password123', '1'),
(6, 'Berrada', 'Fatima', '1006', 'fatima.berrada@voxnet.ma', 'password123', '1'),
(7, 'El Mansouri', 'Rachid', '1007', 'rachid.elmns@voxnet.ma', 'password123', '1'),
(8, 'Bennis', 'Leila', '1008', 'leila.bennis@voxnet.ma', 'password123', '1'),
(9, 'Kabbaj', 'Mehdi', '1009', 'mehdi.kabbaj@voxnet.ma', 'password123', '1'),
(10, 'Benjelloun', 'Samira', '1010', 'samira.benjelloun@voxnet.ma', 'password123', '1');

-- =====================================================
-- 3. INSERTION DE LA CAMPAGNE
-- =====================================================
TRUNCATE TABLE campagne;

INSERT INTO `campagne` (`nom`, `tabmysql`, `active`) VALUES 
('Prospection Alpha', 'Table_Metier_Alpha', 'Oui');

-- =====================================================
-- 4. GÉNÉRATION DES 100 LEADS (Table_Metier_Alpha)
-- =====================================================
TRUNCATE TABLE Table_Metier_Alpha;

-- Insertion des 50 premiers leads avec dates d'appel
INSERT INTO `Table_Metier_Alpha` (`id_lead`, `Nom`, `Prenom`, `TEL`, `Status`, `agent_id`, `dateappel`) VALUES
(1, 'Robert', 'Lucas', '0601000001', 'Vente', 1, '2026-03-02 09:10:00'),
(2, 'Petit', 'Julie', '0601000002', 'Rappel personnel', 1, '2026-03-02 09:20:00'),
(3, 'Moreau', 'Jean', '0601000003', 'Répondeur', 1, '2026-03-02 09:30:00'),
(4, 'Lefebvre', 'Clara', '0601000004', 'Ne répond pas', 1, '2026-03-02 09:40:00'),
(5, 'Garcia', 'Felix', '0601000005', 'Vente', 2, '2026-03-02 10:05:00'),
(6, 'Bertrand', 'Sophie', '0601000006', 'Rappel personnel', 2, '2026-03-02 10:15:00'),
(7, 'Roux', 'David', '0601000007', 'Répondeur', 2, '2026-03-02 10:25:00'),
(8, 'Vincent', 'Emma', '0601000008', 'Ne répond pas', 2, '2026-03-02 10:35:00'),
(9, 'Fournier', 'Marc', '0601000009', 'Vente', 3, '2026-03-02 11:00:00'),
(10, 'Girard', 'Lucie', '0601000010', 'Refus', 3, '2026-03-02 11:10:00'),
(11, 'Andre', 'Pierre', '0601000011', 'Vente', 1, '2026-03-02 11:20:00'),
(12, 'Mercier', 'Lea', '0601000012', 'Répondeur', 1, '2026-03-02 11:30:00'),
(13, 'Guillot', 'Tom', '0601000013', 'Vente', 2, '2026-03-02 14:00:00'),
(14, 'Noel', 'Chloe', '0601000014', 'Rappel personnel', 2, '2026-03-02 14:10:00'),
(15, 'Meyer', 'Eric', '0601000015', 'Refus', 2, '2026-03-02 14:20:00'),
(16, 'Barbier', 'Sarah', '0601000016', 'Vente', 3, '2026-03-02 14:30:00'),
(17, 'Dumas', 'Alain', '0601000017', 'Répondeur', 3, '2026-03-02 14:40:00'),
(18, 'Brun', 'Hugo', '0601000018', 'Ne répond pas', 3, '2026-03-02 14:50:00'),
(19, 'Blanchard', 'Eva', '0601000019', 'Vente', 4, '2026-03-02 15:00:00'),
(20, 'Guerin', 'Paul', '0601000020', 'Refus', 4, '2026-03-02 15:10:00'),
(21, 'Hubert', 'Ines', '0601000021', 'Vente', 5, '2026-03-02 15:20:00'),
(22, 'Masson', 'Loic', '0601000022', 'Répondeur', 5, '2026-03-02 15:30:00'),
(23, 'Morel', 'Anne', '0601000023', 'Vente', 6, '2026-03-02 15:40:00'),
(24, 'Giraud', 'Theo', '0601000024', 'Rappel personnel', 6, '2026-03-02 15:50:00'),
(25, 'Perrin', 'Jade', '0601000025', 'Refus', 7, '2026-03-02 16:00:00'),
(26, 'Laine', 'Cyril', '0601000026', 'Vente', 7, '2026-03-02 16:10:00'),
(27, 'Boucher', 'Manon', '0601000027', 'Répondeur', 8, '2026-03-02 16:20:00'),
(28, 'Renard', 'Leo', '0601000028', 'Vente', 8, '2026-03-02 16:30:00'),
(29, 'Leclerc', 'Nina', '0601000029', 'Ne répond pas', 9, '2026-03-02 16:40:00'),
(30, 'Arnaud', 'Simon', '0601000030', 'Vente', 9, '2026-03-02 16:50:00'),
(31, 'Bernard', 'Alice', '0601000031', 'Intéressé', 10, '2026-03-03 09:15:00'),
(32, 'Dubois', 'Thomas', '0601000032', 'Vente', 10, '2026-03-03 09:45:00'),
(33, 'Martin', 'Laura', '0601000033', 'Répondeur', 1, '2026-03-03 10:30:00'),
(34, 'Durand', 'Nicolas', '0601000034', 'Refus', 2, '2026-03-03 11:00:00'),
(35, 'Leroy', 'Camille', '0601000035', 'Vente', 3, '2026-03-03 14:20:00'),
(36, 'Fontaine', 'Antoine', '0601000036', 'Rappel personnel', 4, '2026-03-03 15:10:00'),
(37, 'Rousseau', 'Manon', '0601000037', 'Vente', 5, '2026-03-04 09:30:00'),
(38, 'Blanc', 'Julien', '0601000038', 'Ne répond pas', 6, '2026-03-04 10:45:00'),
(39, 'Garnier', 'Elodie', '0601000039', 'Vente', 7, '2026-03-04 11:30:00'),
(40, 'Chevalier', 'Maxime', '0601000040', 'Répondeur', 8, '2026-03-04 14:15:00'),
(41, 'Francois', 'Marine', '0601000041', 'Vente', 9, '2026-03-04 15:45:00'),
(42, 'Legrand', 'Alexandre', '0601000042', 'Refus', 10, '2026-03-05 09:20:00'),
(43, 'Gauthier', 'Helene', '0601000043', 'Vente', 1, '2026-03-05 10:50:00'),
(44, 'Martinez', 'Luis', '0601000044', 'Rappel personnel', 2, '2026-03-05 11:40:00'),
(45, 'Lopez', 'Carmen', '0601000045', 'Vente', 3, '2026-03-05 14:30:00'),
(46, 'Sanchez', 'Carlos', '0601000046', 'Intéressé', 4, '2026-03-05 15:20:00'),
(47, 'Gonzalez', 'Elena', '0601000047', 'Vente', 5, '2026-03-06 09:10:00'),
(48, 'Perez', 'Javier', '0601000048', 'Répondeur', 6, '2026-03-06 10:30:00'),
(49, 'Rodriguez', 'Sofia', '0601000049', 'Vente', 7, '2026-03-06 11:15:00'),
(50, 'Rossi', 'Marco', '0601000050', 'Refus', 8, '2026-03-06 14:45:00');

-- Insertion des 50 leads suivants (sans date d'appel = "A traiter")
INSERT INTO `Table_Metier_Alpha` (`id_lead`, `Nom`, `Prenom`, `TEL`, `Status`, `agent_id`, `dateappel`) VALUES
(51, 'Ferrari', 'Luigi', '0601000051', 'A traiter', NULL, NULL),
(52, 'Ricci', 'Giulia', '0601000052', 'A traiter', NULL, NULL),
(53, 'Conti', 'Paolo', '0601000053', 'A traiter', NULL, NULL),
(54, 'Moretti', 'Anna', '0601000054', 'A traiter', NULL, NULL),
(55, 'Romano', 'Marco', '0601000055', 'A traiter', NULL, NULL),
(56, 'Gallo', 'Laura', '0601000056', 'A traiter', NULL, NULL),
(57, 'Costa', 'Giovanni', '0601000057', 'A traiter', NULL, NULL),
(58, 'Fontana', 'Francesca', '0601000058', 'A traiter', NULL, NULL),
(59, 'Santoro', 'Andrea', '0601000059', 'A traiter', NULL, NULL),
(60, 'Marino', 'Roberta', '0601000060', 'A traiter', NULL, NULL),
(61, 'Greco', 'Stefano', '0601000061', 'A traiter', NULL, NULL),
(62, 'Bruno', 'Valentina', '0601000062', 'A traiter', NULL, NULL),
(63, 'Rizzo', 'Alessandro', '0601000063', 'A traiter', NULL, NULL),
(64, 'Galli', 'Martina', '0601000064', 'A traiter', NULL, NULL),
(65, 'Conti', 'Simone', '0601000065', 'A traiter', NULL, NULL),
(66, 'De Luca', 'Chiara', '0601000066', 'A traiter', NULL, NULL),
(67, 'Giordano', 'Davide', '0601000067', 'A traiter', NULL, NULL),
(68, 'Mancini', 'Sara', '0601000068', 'A traiter', NULL, NULL),
(69, 'Longo', 'Federico', '0601000069', 'A traiter', NULL, NULL),
(70, 'Gentile', 'Elena', '0601000070', 'A traiter', NULL, NULL),
(71, 'Martinelli', 'Matteo', '0601000071', 'A traiter', NULL, NULL),
(72, 'Vitale', 'Giorgia', '0601000072', 'A traiter', NULL, NULL),
(73, 'Lombardi', 'Riccardo', '0601000073', 'A traiter', NULL, NULL),
(74, 'Serra', 'Beatrice', '0601000074', 'A traiter', NULL, NULL),
(75, 'Coppola', 'Vincenzo', '0601000075', 'A traiter', NULL, NULL),
(76, 'De Angelis', 'Alessia', '0601000076', 'A traiter', NULL, NULL),
(77, 'Ferri', 'Lorenzo', '0601000077', 'A traiter', NULL, NULL),
(78, 'Monti', 'Valeria', '0601000078', 'A traiter', NULL, NULL),
(79, 'Testa', 'Claudio', '0601000079', 'A traiter', NULL, NULL),
(80, 'Grassi', 'Patrizia', '0601000080', 'A traiter', NULL, NULL),
(81, 'Pellegrini', 'Angelo', '0601000081', 'A traiter', NULL, NULL),
(82, 'Bianchi', 'Monica', '0601000082', 'A traiter', NULL, NULL),
(83, 'Marchetti', 'Enrico', '0601000083', 'A traiter', NULL, NULL),
(84, 'Mazza', 'Daniela', '0601000084', 'A traiter', NULL, NULL),
(85, 'Barbieri', 'Giacomo', '0601000085', 'A traiter', NULL, NULL),
(86, 'Barone', 'Federica', '0601000086', 'A traiter', NULL, NULL),
(87, 'Palmieri', 'Salvatore', '0601000087', 'A traiter', NULL, NULL),
(88, 'Russo', 'Teresa', '0601000088', 'A traiter', NULL, NULL),
(89, 'Villa', 'Mario', '0601000089', 'A traiter', NULL, NULL),
(90, 'Sartori', 'Rosa', '0601000090', 'A traiter', NULL, NULL),
(91, 'Messina', 'Antonio', '0601000091', 'A traiter', NULL, NULL),
(92, 'Piras', 'Caterina', '0601000092', 'A traiter', NULL, NULL),
(93, 'Carbone', 'Domenico', '0601000093', 'A traiter', NULL, NULL),
(94, 'Cattaneo', 'Lucia', '0601000094', 'A traiter', NULL, NULL),
(95, 'Riva', 'Fabio', '0601000095', 'A traiter', NULL, NULL),
(96, 'Fabbri', 'Elisa', '0601000096', 'A traiter', NULL, NULL),
(97, 'Battaglia', 'Massimo', '0601000097', 'A traiter', NULL, NULL),
(98, 'Parisi', 'Raffaella', '0601000098', 'A traiter', NULL, NULL),
(99, 'Neri', 'Michele', '0601000099', 'A traiter', NULL, NULL),
(100, 'Gatti', 'Silvia', '0601000100', 'A traiter', NULL, NULL);

-- =====================================================
-- 5. GÉNÉRATION DES 100 ENTRIES CDR
-- =====================================================
TRUNCATE TABLE cdr;

-- 30 premiers CDR correspondant aux 30 premiers leads
INSERT INTO `cdr` (`calldate`, `src`, `dst`, `duration`, `billsec`, `disposition`) VALUES
('2026-03-02 09:08:45', '1001', '0601000001', 125, 110, 'ANSWERED'),
('2026-03-02 09:19:10', '1001', '0601000002', 65, 50, 'ANSWERED'),
('2026-03-02 09:29:55', '1001', '0601000003', 25, 15, 'ANSWERED'),
('2026-03-02 09:39:30', '1001', '0601000004', 40, 0, 'NO ANSWER'),
('2026-03-02 10:04:12', '1002', '0601000005', 310, 290, 'ANSWERED'),
('2026-03-02 10:14:45', '1002', '0601000006', 90, 75, 'ANSWERED'),
('2026-03-02 10:24:20', '1002', '0601000007', 30, 22, 'ANSWERED'),
('2026-03-02 10:34:10', '1002', '0601000008', 20, 0, 'NO ANSWER'),
('2026-03-02 10:59:05', '1003', '0601000009', 450, 430, 'ANSWERED'),
('2026-03-02 11:09:40', '1003', '0601000010', 110, 95, 'ANSWERED'),
('2026-03-02 11:18:50', '1001', '0601000011', 280, 260, 'ANSWERED'),
('2026-03-02 11:29:30', '1001', '0601000012', 35, 20, 'ANSWERED'),
('2026-03-02 13:58:15', '1002', '0601000013', 400, 380, 'ANSWERED'),
('2026-03-02 14:09:40', '1002', '0601000014', 150, 130, 'ANSWERED'),
('2026-03-02 14:19:05', '1002', '0601000015', 180, 160, 'ANSWERED'),
('2026-03-02 14:28:40', '1003', '0601000016', 320, 305, 'ANSWERED'),
('2026-03-02 14:39:15', '1003', '0601000017', 45, 30, 'ANSWERED'),
('2026-03-02 14:48:50', '1003', '0601000018', 25, 0, 'BUSY'),
('2026-03-02 14:59:10', '1004', '0601000019', 360, 345, 'ANSWERED'),
('2026-03-02 15:09:45', '1004', '0601000020', 210, 190, 'ANSWERED'),
('2026-03-02 15:19:12', '1005', '0601000021', 415, 400, 'ANSWERED'),
('2026-03-02 15:29:40', '1005', '0601000022', 55, 40, 'ANSWERED'),
('2026-03-02 15:38:15', '1006', '0601000023', 500, 480, 'ANSWERED'),
('2026-03-02 15:49:10', '1006', '0601000024', 130, 115, 'ANSWERED'),
('2026-03-02 15:59:25', '1007', '0601000025', 160, 145, 'ANSWERED'),
('2026-03-02 16:09:45', '1007', '0601000026', 390, 370, 'ANSWERED'),
('2026-03-02 16:19:15', '1008', '0601000027', 45, 30, 'ANSWERED'),
('2026-03-02 16:29:10', '1008', '0601000028', 520, 505, 'ANSWERED'),
('2026-03-02 16:39:05', '1009', '0601000029', 30, 0, 'NO ANSWER'),
('2026-03-02 16:49:12', '1009', '0601000030', 440, 420, 'ANSWERED');

-- 20 CDR pour les leads 31-50 (journée du 3 mars)
INSERT INTO `cdr` (`calldate`, `src`, `dst`, `duration`, `billsec`, `disposition`) VALUES
('2026-03-03 09:14:30', '1010', '0601000031', 210, 180, 'ANSWERED'),
('2026-03-03 09:44:20', '1010', '0601000032', 320, 300, 'ANSWERED'),
('2026-03-03 10:29:45', '1001', '0601000033', 45, 30, 'ANSWERED'),
('2026-03-03 10:59:30', '1002', '0601000034', 180, 160, 'ANSWERED'),
('2026-03-03 14:19:40', '1003', '0601000035', 410, 390, 'ANSWERED'),
('2026-03-03 15:09:20', '1004', '0601000036', 90, 75, 'ANSWERED'),
('2026-03-04 09:28:50', '1005', '0601000037', 380, 360, 'ANSWERED'),
('2026-03-04 10:44:10', '1006', '0601000038', 35, 0, 'NO ANSWER'),
('2026-03-04 11:29:40', '1007', '0601000039', 420, 400, 'ANSWERED'),
('2026-03-04 14:14:30', '1008', '0601000040', 55, 40, 'ANSWERED'),
('2026-03-04 15:44:20', '1009', '0601000041', 460, 440, 'ANSWERED'),
('2026-03-05 09:19:30', '1010', '0601000042', 120, 100, 'ANSWERED'),
('2026-03-05 10:49:15', '1001', '0601000043', 390, 370, 'ANSWERED'),
('2026-03-05 11:39:40', '1002', '0601000044', 140, 120, 'ANSWERED'),
('2026-03-05 14:29:20', '1003', '0601000045', 440, 420, 'ANSWERED'),
('2026-03-05 15:19:10', '1004', '0601000046', 180, 160, 'ANSWERED'),
('2026-03-06 09:09:30', '1005', '0601000047', 320, 300, 'ANSWERED'),
('2026-03-06 10:29:20', '1006', '0601000048', 60, 45, 'ANSWERED'),
('2026-03-06 11:14:40', '1007', '0601000049', 380, 360, 'ANSWERED'),
('2026-03-06 14:44:20', '1008', '0601000050', 220, 200, 'ANSWERED');

-- 50 CDR supplémentaires pour compléter (appels divers)
INSERT INTO `cdr` (`calldate`, `src`, `dst`, `duration`, `billsec`, `disposition`) VALUES
('2026-03-07 09:05:00', '1001', '0601000055', 150, 130, 'ANSWERED'),
('2026-03-07 10:15:30', '1002', '0601000056', 280, 260, 'ANSWERED'),
('2026-03-07 11:25:15', '1003', '0601000057', 90, 75, 'ANSWERED'),
('2026-03-07 14:35:45', '1004', '0601000058', 410, 390, 'ANSWERED'),
('2026-03-07 15:45:20', '1005', '0601000059', 60, 45, 'ANSWERED'),
('2026-03-07 16:55:10', '1006', '0601000060', 25, 0, 'BUSY'),
('2026-03-08 09:08:30', '1007', '0601000061', 340, 320, 'ANSWERED'),
('2026-03-08 10:18:40', '1008', '0601000062', 120, 100, 'ANSWERED'),
('2026-03-08 11:28:50', '1009', '0601000063', 380, 360, 'ANSWERED'),
('2026-03-08 14:38:15', '1010', '0601000064', 200, 180, 'ANSWERED'),
('2026-03-08 15:48:30', '1001', '0601000065', 95, 80, 'ANSWERED'),
('2026-03-08 16:58:45', '1002', '0601000066', 30, 0, 'NO ANSWER'),
('2026-03-09 09:09:00', '1003', '0601000067', 420, 400, 'ANSWERED'),
('2026-03-09 10:19:30', '1004', '0601000068', 150, 130, 'ANSWERED'),
('2026-03-09 11:29:45', '1005', '0601000069', 280, 260, 'ANSWERED'),
('2026-03-09 14:39:15', '1006', '0601000070', 190, 170, 'ANSWERED'),
('2026-03-09 15:49:30', '1007', '0601000071', 360, 340, 'ANSWERED'),
('2026-03-09 16:59:45', '1008', '0601000072', 40, 0, 'BUSY'),
('2026-03-10 09:10:15', '1009', '0601000073', 310, 290, 'ANSWERED'),
('2026-03-10 10:20:30', '1010', '0601000074', 130, 110, 'ANSWERED'),
('2026-03-10 11:30:45', '1001', '0601000075', 390, 370, 'ANSWERED'),
('2026-03-10 14:40:15', '1002', '0601000076', 180, 160, 'ANSWERED'),
('2026-03-10 15:50:30', '1003', '0601000077', 410, 390, 'ANSWERED'),
('2026-03-10 17:00:45', '1004', '0601000078', 55, 40, 'ANSWERED'),
('2026-03-11 09:11:00', '1005', '0601000079', 290, 270, 'ANSWERED'),
('2026-03-11 10:21:30', '1006', '0601000080', 110, 90, 'ANSWERED'),
('2026-03-11 11:31:45', '1007', '0601000081', 370, 350, 'ANSWERED'),
('2026-03-11 14:41:15', '1008', '0601000082', 140, 120, 'ANSWERED'),
('2026-03-11 15:51:30', '1009', '0601000083', 400, 380, 'ANSWERED'),
('2026-03-11 17:01:45', '1010', '0601000084', 85, 70, 'ANSWERED'),
('2026-03-12 09:12:00', '1001', '0601000085', 250, 230, 'ANSWERED'),
('2026-03-12 10:22:30', '1002', '0601000086', 170, 150, 'ANSWERED'),
('2026-03-12 11:32:45', '1003', '0601000087', 330, 310, 'ANSWERED'),
('2026-03-12 14:42:15', '1004', '0601000088', 190, 170, 'ANSWERED'),
('2026-03-12 15:52:30', '1005', '0601000089', 420, 400, 'ANSWERED'),
('2026-03-12 17:02:45', '1006', '0601000090', 65, 50, 'ANSWERED'),
('2026-03-13 09:13:00', '1007', '0601000091', 280, 260, 'ANSWERED'),
('2026-03-13 10:23:30', '1008', '0601000092', 125, 105, 'ANSWERED'),
('2026-03-13 11:33:45', '1009', '0601000093', 350, 330, 'ANSWERED'),
('2026-03-13 14:43:15', '1010', '0601000094', 210, 190, 'ANSWERED'),
('2026-03-13 15:53:30', '1001', '0601000095', 440, 420, 'ANSWERED'),
('2026-03-13 17:03:45', '1002', '0601000096', 45, 30, 'ANSWERED'),
('2026-03-14 09:14:00', '1003', '0601000097', 290, 270, 'ANSWERED'),
('2026-03-14 10:24:30', '1004', '0601000098', 155, 135, 'ANSWERED'),
('2026-03-14 11:34:45', '1005', '0601000099', 380, 360, 'ANSWERED'),
('2026-03-14 14:44:15', '1006', '0601000100', 220, 200, 'ANSWERED'),
('2026-03-14 15:54:30', '1007', '0601000051', 115, 95, 'ANSWERED'),
('2026-03-14 17:04:45', '1008', '0601000052', 35, 0, 'NO ANSWER'),
('2026-03-15 09:15:00', '1009', '0601000053', 320, 300, 'ANSWERED'),
('2026-03-15 10:25:30', '1010', '0601000054', 165, 145, 'ANSWERED');


```

## 🚀 Utilisation

### Accès aux modules
| Module | URL | Description |
|--------|-----|-------------|
| **Dashboard** | `/index.php` | Vue d'ensemble des performances |
| **Agents** | `/modules/agents.php` | Gestion des agents |
| **Campagnes** | `/modules/campagnes.php` | Liste des campagnes |
| **Métier** | `/modules/metier.php` | Gestion des leads |
| **CDR** | `/modules/cdr.php` | Logs techniques |

### Fonctionnalités clés

#### 📊 Dashboard
- Visualisez les **KPI** en haut de page
- Consultez les **graphiques** de répartition
- Parcourez le **classement des agents**
- Explorez les **données réconciliées**

#### 👥 Gestion des Agents
- **Ajouter** : formulaire complet
- **Modifier** : pré-remplissage automatique
- **Supprimer** : confirmation individuelle ou multiple
- **Filtres** : recherche par nom/extension

#### 📞 Gestion des Leads
- **CRUD complet** sur les leads
- **Filtres avancés** par statut, agent, recherche
- **Export CSV** des données
- **Vue liée** vers les logs CDR

## 🔌 API

### Endpoint : `/api/chart-data.php`
Renvoie les données pour les graphiques au format JSON :

```json
{
  "status": {
    "labels": ["Vente", "Refus", "Rappel", "Répondeur", "A traiter"],
    "values": [25, 15, 10, 20, 30]
  },
  "agents": {
    "labels": ["Ahmed Alami", "Siham Benani", "Omar Idrissi"],
    "appels": [45, 38, 52],
    "ventes": [15, 12, 18]
  }
}
```

## 🙏 Remerciements

- **Voxnet** pour l'opportunité de stage
- **Bootstrap** pour le framework CSS
- **Chart.js** pour les graphiques
- **DataTables** pour les tableaux interactifs


---

**Fait par ZOOMxx and AI**