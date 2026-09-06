/**
 * Frontend layout scripts
 * - Mobile menu toggle
 * - FAQ accordion
 */
(function () {
    'use strict';

    /* =========================================================
     * Mobile menu toggle
     * ========================================================= */
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    }

    /* =========================================================
     * FAQ accordion
     * ========================================================= */
    document.querySelectorAll('.faq-toggle').forEach((btn) => {
        btn.addEventListener('click', () => {
            const target = document.getElementById(btn.dataset.target);
            const icon = btn.querySelector('.faq-icon');
            const isHidden = target.classList.contains('hidden');
            // Close all
            document.querySelectorAll('.faq-answer').forEach((a) => a.classList.add('hidden'));
            document.querySelectorAll('.faq-icon').forEach((i) => i.classList.remove('rotate-180'));
            // Open clicked
            if (isHidden) {
                target.classList.remove('hidden');
                icon.classList.add('rotate-180');
            }
        });
    });
})();
