
/*
========================================
MI DARUL ULUM GEDONGAN
HERO & SAMBUTAN ANIMATION
========================================
*/

function initTextAnimation() {

    const reduceMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    if (reduceMotion) return;

    // =====================================
    // FUNGSI ANIMASI
    // =====================================

    function animateElement(element, delay = 0, direction = 'up') {

        if (!element || !element.animate) return;

        let x = 0;
        let y = 35;

        if (direction === 'left') {
            x = -45;
            y = 0;
        }

        if (direction === 'right') {
            x = 45;
            y = 0;
        }

        const animation = element.animate(
            [
                {
                    opacity: 0,
                    transform: `translate3d(${x}px, ${y}px, 0)`,
                    filter: 'blur(5px)'
                },
                {
                    opacity: 1,
                    transform: 'translate3d(0, 0, 0)',
                    filter: 'blur(0)'
                }
            ],
            {
                duration: 900,
                delay: delay,
                easing: 'cubic-bezier(0.22, 1, 0.36, 1)',
                fill: 'both'
            }
        );

        animation.onfinish = () => {
            animation.cancel();
        };
    }

    // =====================================
    // HERO SECTION
    // =====================================

    const heroTexts = document.querySelectorAll(
        '#beranda .hero-enter > *'
    );

    heroTexts.forEach((element, index) => {

        animateElement(
            element,
            100 + index * 160,
            'up'
        );

    });

    console.log(
        '[Animation] Hero:',
        heroTexts.length
    );

    // =====================================
    // SAMBUTAN KEPALA MADRASAH
    // =====================================

    const section = document.querySelector(
        '#kepala-sekolah'
    );

    if (!section) {
        console.warn('Section kepala sekolah tidak ditemukan');
        return;
    }

    // Sesuai struktur Blade asli:
    // Section > Container Grid > Kolom Kanan
    const layout = section.querySelector(
        ':scope > div.relative.mx-auto.grid'
    );

    const content = layout?.lastElementChild;

    if (!content) {
        console.warn('Kolom sambutan tidak ditemukan');
        return;
    }

    // Ambil elemen utama pada kolom kanan
    const elements = [];

    Array.from(content.children).forEach(child => {

        // Tiga nilai pendidikan dianimasikan satu per satu
        if (child.classList.contains('grid')) {
            elements.push(...child.children);
        } else {
            elements.push(child);
        }

    });

    console.log(
        '[Animation] Sambutan:',
        elements.length
    );

    
// =====================================
// ANIMASI FOTO KEPALA SEKOLAH
// =====================================

// Mengambil kolom foto di sebelah kiri
const photoContainer = layout?.firstElementChild;

if (photoContainer) {

    const photoObserver = new IntersectionObserver(
        (entries, observer) => {

            entries.forEach(entry => {

                if (!entry.isIntersecting) return;

                const animation = photoContainer.animate(
                    [
                        {
                            opacity: 0,
                            transform: 'translateX(-70px) scale(0.92)',
                            filter: 'blur(8px)'
                        },
                        {
                            opacity: 1,
                            transform: 'translateX(0) scale(1)',
                            filter: 'blur(0)'
                        }
                    ],
                    {
                        duration: 1100,
                        delay: 150,
                        easing: 'cubic-bezier(0.22, 1, 0.36, 1)',
                        fill: 'both'
                    }
                );

                animation.onfinish = () => {
                    animation.cancel();
                };

                observer.unobserve(entry.target);
            });

        },
        {
            threshold: 0.15,
            rootMargin: '0px 0px -30px 0px'
        }
    );

    photoObserver.observe(photoContainer);
    
// Badge identitas kepala madrasah
const photoBadge = photoContainer.querySelector(
    '.absolute.-bottom-2'
);

if (photoBadge) {

    const badgeObserver = new IntersectionObserver(
        (entries, observer) => {

            entries.forEach(entry => {

                if (!entry.isIntersecting) return;

                animateElement(
                    photoBadge,
                    650,
                    'up'
                );

                observer.unobserve(entry.target);
            });

        },
        {
            threshold: 0.2
        }
    );

    badgeObserver.observe(photoBadge);
}

}

    // =====================================
    // SCROLL OBSERVER
    // =====================================

    if ('IntersectionObserver' in window) {

        const observer = new IntersectionObserver(
            (entries, obs) => {

                entries.forEach(entry => {

                    if (!entry.isIntersecting) return;

                    const element = entry.target;
                    const index = elements.indexOf(element);

                    animateElement(
                        element,
                        (index % 4) * 130,
                        'up'
                    );

                    obs.unobserve(element);

                });

            },
            {
                threshold: 0.1,
                rootMargin: '0px 0px -30px 0px'
            }
        );

        elements.forEach(element => {
            observer.observe(element);
        });

    } else {

        elements.forEach((element, index) => {
            animateElement(element, index * 130);
        });

    }

}

// =====================================
// JALANKAN SETELAH DOM SIAP
// =====================================

if (document.readyState === 'loading') {

    document.addEventListener(
        'DOMContentLoaded',
        initTextAnimation,
        { once: true }
    );

} else {

    initTextAnimation();

}
