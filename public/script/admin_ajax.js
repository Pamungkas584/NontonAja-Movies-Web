document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInputAdmin');
    const tableBody = document.getElementById('tableBody');
    const paginationContainer = document.getElementById('paginationContainer');
    let timeout = null;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            
            timeout = setTimeout(() => {
                const query = this.value;
                // Mengambil URL rute Laravel dari atribut data-url pada input
                const url = this.dataset.url; 

                fetch(`${url}?search=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    const newTbody = doc.getElementById('tableBody');
                    const newPagination = doc.getElementById('paginationContainer');
                    
                    if (newTbody && tableBody) tableBody.innerHTML = newTbody.innerHTML;
                    if (newPagination && paginationContainer) paginationContainer.innerHTML = newPagination.innerHTML;

                    const newUrl = query ? `${window.location.pathname}?search=${query}` : window.location.pathname;
                    window.history.pushState({path: newUrl}, '', newUrl);
                })
                .catch(error => console.error('Error saat mencari data:', error));
            }, 400); 
        });
    }
});