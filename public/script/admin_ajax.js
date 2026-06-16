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

    // LOGIKA MODAL OVERLAY HAPUS FILM
    let formToSubmit = null;
    const deleteModal = document.getElementById('deleteModal');
    const deleteModalMovieTitle = document.getElementById('deleteModalMovieTitle');
    const btnCancelDelete = document.getElementById('btnCancelDelete');
    const btnConfirmDelete = document.getElementById('btnConfirmDelete');

    // Menggunakan Event Delegation (e.target.closest) agar tombol hapus 
    // tetap berfungsi normal walaupun tabel dirender ulang oleh AJAX pencarian
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('.btn-delete-trigger');
        
        if (trigger) {
            e.preventDefault();
            const formId = trigger.getAttribute('data-form-id');
            const movieTitle = trigger.getAttribute('data-title');
            
            formToSubmit = document.getElementById(formId);
            
            if (formToSubmit && deleteModal) {
                // Masukkan teks judul film ke dalam modal
                deleteModalMovieTitle.textContent = movieTitle;
                
                // Tampilkan overlay modal dengan animasi transisi yang halus
                deleteModal.classList.remove('hidden');
                setTimeout(() => {
                    deleteModal.classList.remove('opacity-0');
                    deleteModal.querySelector('.scale-95').classList.replace('scale-95', 'scale-100');
                }, 10);
            }
        }
    });

    // Fungsi menutup modal
    function closeDeleteModal() {
        if (deleteModal) {
            deleteModal.classList.add('opacity-0');
            deleteModal.querySelector('.scale-100').classList.replace('scale-100', 'scale-95');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
                formToSubmit = null;
            }, 300); // Sinkron dengan durasi transition duration-300 Tailwind
        }
    }

    // Aksi tombol Batal
    if (btnCancelDelete) {
        btnCancelDelete.addEventListener('click', closeDeleteModal);
    }

    // Aksi tombol Ya, Hapus (Submit Form)
    if (btnConfirmDelete) {
        btnConfirmDelete.addEventListener('click', function() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });
    }

    // Menutup modal jika admin tidak sengaja klik area gelap di luar kotak modal
    if (deleteModal) {
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                closeDeleteModal();
            }
        });
    }

});