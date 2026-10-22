
/*
 * MI DARUL ULUM GEDONGAN
 * Scroll Reveal Animation
 */

function initScrollReveal() {

    const prefersReducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    if (
        prefersReducedMotion ||
        !('IntersectionObserver' in window)
    ) {
        return;
    }

    const targets = new Map();

    // Daftarkan elemen yang akan dianimasikan
    function add(selector, direction = 'up', delay = 120) {

        document.querySelectorAll(selector).forEach((el, index) => {

            if (targets.has(el)) return;

            let finalDirection = direction;

            if (direction === 'alternate') {
                finalDirection = index % 2 === 0 ? 'left' : 'right';
            }

            targets.set(el, {
                direction: finalDirection,
                delay: (index % 3) * delay
            });
        });
    }

    // VISI MISI
    add('#visi-misi h2', 'up', 0);
    add('#visi-misi .group', 'up', 130);

    // SAMBUTAN KEPALA SEKOLAH
    add('#sambutan h2, #sambutan-kepala h2', 'up', 0);
    add(
        '#sambutan .grid > div, #sambutan-kepala .grid > div',
        'alternate',
        200
    );

    
// =====================================
// ANIMASI TEKS SAMBUTAN KEPALA SEKOLAH
// =====================================

// Salam pembuka
add(
    '#sambutan .grid > div:last-child > p',
    'up',
    120
);

// Judul sambutan
add(
    '#sambutan .grid > div:last-child > h3',
    'up',
    150
);

// Paragraf isi sambutan
add(
    '#sambutan .grid > div:last-child .mt-6 > p',
    'up',
    180
);

// Tombol baca sambutan
add(
    '#sambutan .grid > div:last-child > button',
    'up',
    200
);

    // BERITA
    add('#berita-prestasi h2', 'up', 0);
    add('#berita-prestasi article', 'up', 140);

    // FOOTER
    add('footer .grid > div', 'up', 120);

    // MENYIAPKAN ANIMASI
    targets.forEach((config, el) => {

        el.classList.add('sr-target');

        let x = '0px';
        let y = '35px';

        if (config.direction === 'left') {
            x = '-50px';
            y = '0px';
        }

        if (config.direction === 'right') {
            x = '50px';
            y = '0px';
        }

        el.style.setProperty('--sr-x', x);
        el.style.setProperty('--sr-y', y);
        el.style.setProperty('--sr-delay', config.delay + 'ms');
    });

    // DETEKSI SAAT ELEMEN TERLIHAT
    const observer = new IntersectionObserver((entries, obs) => {

        entries.forEach(entry => {

            if (!entry.isIntersecting) return;

            const el = entry.target;

            el.addEventListener('transitionend', (event) => {

                if (event.target !== el ||
                    event.propertyName !== 'opacity') return;

                // Pulihkan styling agar hover tetap normal
                el.classList.remove('sr-target', 'sr-visible');

                el.style.removeProperty('--sr-x');
                el.style.removeProperty('--sr-y');
                el.style.removeProperty('--sr-delay');

            });

            el.classList.add('sr-visible');
            obs.unobserve(el);

        });

    }, {
        threshold: 0.05,
        rootMargin: '0px 0px -20px 0px'
    });

    targets.forEach((config, el) => observer.observe(el));

    console.log(
        '[Scroll Reveal] Berhasil dijalankan:',
        targets.size,
        'elemen'
    );
}

// Jalankan ketika HTML siap
if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        initScrollReveal,
        { once: true }
    );
} else {
    initScrollReveal();
}
