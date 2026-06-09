document.addEventListener('DOMContentLoaded', function() {
    
    // DROPDOWN MENU (GLOBAL)
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

    // CAROUSEL ( HOME)
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

    // DRAG TO SCROLL (HALAMAN HOME)
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
                const walk = (x - startX) * 1.5; // Angka 1.5 adalah kecepatan scroll
                slider.scrollLeft = scrollLeft - walk;
            });
        });
    }
});