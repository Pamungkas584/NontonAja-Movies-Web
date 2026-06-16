document.addEventListener('DOMContentLoaded', function() {
    
    //DROPDOWN MENU (GLOBAL)
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (profileBtn && dropdownMenu) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', (e) => {
            if (!dropdownMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }

    //CAROUSEL (HOME)
    const slides = document.querySelectorAll('.carousel-item');
    if (slides.length > 0) {
        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            if (index >= slides.length) currentSlide = 0;
            else if (index < 0) currentSlide = slides.length - 1;
            else currentSlide = index;

            slides.forEach((slide, i) => {
                if (i === currentSlide) {
                    slide.classList.replace('opacity-0', 'opacity-100');
                    slide.classList.replace('z-0', 'z-10');
                } else {
                    slide.classList.replace('opacity-100', 'opacity-0');
                    slide.classList.replace('z-10', 'z-0');
                }
            });
        }

        function nextSlide() { showSlide(currentSlide + 1); }
        function prevSlide() { showSlide(currentSlide - 1); }

        if (slides.length > 1) {
            slideInterval = setInterval(nextSlide, 5000);
        }

        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                clearInterval(slideInterval);
                nextSlide();
                slideInterval = setInterval(nextSlide, 5000);
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                clearInterval(slideInterval);
                prevSlide();
                slideInterval = setInterval(nextSlide, 5000);
            });
        }
    }

    //DRAG TO SCROLL (HOME)
    const sliders = document.querySelectorAll('.drag-scroll');
    if (sliders.length > 0) {
        let isDown = false;
        let startX;
        let scrollLeft;

        sliders.forEach(slider => {
            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                slider.classList.add('cursor-grabbing');
                slider.classList.remove('cursor-grab', 'snap-x');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('cursor-grabbing');
                slider.classList.add('cursor-grab', 'snap-x');
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('cursor-grabbing');
                slider.classList.add('cursor-grab', 'snap-x');
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 1.5; 
                slider.scrollLeft = scrollLeft - walk;
            });
        });
    }

    //AJAX PENCARIAN LOKAL & TMDB (GLOBAL)
    const searchInput = document.getElementById('searchInput');
    const searchOverlay = document.getElementById('searchOverlay');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout = null;

    if (searchInput && searchOverlay && searchResults) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout); 
            const query = this.value.trim();

            if (query.length >= 5) {
                // Jeda 400ms agar server tidak kelebihan beban saat user mengetik cepat
                searchTimeout = setTimeout(() => {
                    fetch(`/search/local?q=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            searchResults.innerHTML = ''; 
                            
                            if (data.length > 0) {
                                searchOverlay.classList.remove('hidden');
                                data.forEach(movie => {
                                    // Pastikan URL "/film/" ini sesuai dengan rute show-mu (misal: /film/{id} atau /movies/{id})
                                    searchResults.innerHTML += `
                                        <a href="/movie/${movie.id}" class="flex items-center space-x-4 p-3 border-b border-gray-800 hover:bg-gray-800/50 transition cursor-pointer">
                                            <img src="${movie.thumbnail_url}" alt="${movie.title}" class="w-10 h-14 object-cover rounded shadow">
                                            <div>
                                                <h4 class="text-white text-sm font-bold line-clamp-1">${movie.title}</h4>
                                                <p class="text-gray-500 text-xs">${movie.year} • <span class="text-orange-500 font-bold">★ ${movie.rating}</span></p>
                                            </div>
                                        </a>
                                    `;
                                });
                                searchResults.innerHTML += `
                                    <div class="p-2 text-center bg-gray-900/50">
                                        <span class="text-xs text-gray-500">Tekan Enter untuk mencari di TMDB</span>
                                    </div>
                                `;
                            } else {
                                searchOverlay.classList.remove('hidden');
                                searchResults.innerHTML = `
                                    <div class="p-6 text-center">
                                        <p class="text-gray-400 text-sm mb-2">Film tidak ditemukan di server lokal.</p>
                                        <p class="text-orange-500 text-xs font-bold">Tekan ENTER untuk mencari di seluruh dunia (TMDB).</p>
                                    </div>
                                `;
                            }
                        });
                }, 400); 
            } else {
                searchOverlay.classList.add('hidden');
            }
        });

        // Sembunyikan dropdown overlay jika klik di luar form pencarian
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchOverlay.contains(e.target)) {
                searchOverlay.classList.add('hidden');
            }
        });
    }

});
