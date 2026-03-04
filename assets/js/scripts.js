// Fonctions utilitaires
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formatDate(date) {
    return new Date(date).toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Gestion des notifications
function showNotification(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.querySelector('.container-fluid').prepend(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

// Rafraîchissement automatique du dashboard (optionnel)
if (window.location.pathname.includes('index.php')) {
    setInterval(() => {
        location.reload();
    }, 300000); // Rafraîchir toutes les 5 minutes
}

// Export des tableaux en CSV
function exportTableToCSV(tableId, filename) {
    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll('tr');
    const csv = [];
    
    for (const row of rows) {
        const cells = row.querySelectorAll('td, th');
        const rowData = [];
        for (const cell of cells) {
            rowData.push('"' + cell.innerText.replace(/"/g, '""') + '"');
        }
        csv.push(rowData.join(','));
    }
    
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    a.click();
    window.URL.revokeObjectURL(url);
}

// Ajouter des boutons d'export
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter un bouton d'export aux tableaux
    const tables = document.querySelectorAll('.datatable');
    tables.forEach((table, index) => {
        const wrapper = table.closest('.card-body');
        if (wrapper) {
            const exportBtn = document.createElement('button');
            exportBtn.className = 'btn btn-success btn-sm mb-3';
            exportBtn.innerHTML = '<i class="bi bi-download"></i> Exporter CSV';
            exportBtn.onclick = () => exportTableToCSV(table.id || `table-${index}`, `export-${Date.now()}.csv`);
            wrapper.insertBefore(exportBtn, table);
        }
    });
});