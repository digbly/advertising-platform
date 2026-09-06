/**
 * Admin layout scripts
 * - Theme (light/dark) với localStorage + hệ thống
 * - Sidebar: toggle mobile (off-canvas) + collapse desktop
 * - Dropdown: user menu, notifications
 * - Global search (Ctrl/Cmd + K)
 */
(function () {
    'use strict';

    const STORAGE_THEME = 'admin-theme';
    const STORAGE_SIDEBAR = 'admin-sidebar-collapsed';

    /* =========================================================
     * Theme
     * ========================================================= */
    const root = document.documentElement;

    function getInitialTheme() {
        const stored = localStorage.getItem(STORAGE_THEME);
        if (stored === 'light' || stored === 'dark') {
            return stored;
        }
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    function applyTheme(theme) {
        root.classList.toggle('dark', theme === 'dark');
        localStorage.setItem(STORAGE_THEME, theme);

        document.querySelectorAll('[data-theme-icon]').forEach((icon) => {
            const showSun = theme === 'dark'; // hiện mặt trời khi đang dark -> bấm để sang light
            icon.querySelector('[data-icon="sun"]')?.classList.toggle('hidden', !showSun);
            icon.querySelector('[data-icon="moon"]')?.classList.toggle('hidden', showSun);
        });
    }

    function toggleTheme() {
        applyTheme(root.classList.contains('dark') ? 'light' : 'dark');
    }

    /* =========================================================
     * Sidebar
     * ========================================================= */
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const overlay = document.getElementById('sidebar-overlay');

    function isDesktop() {
        return window.matchMedia('(min-width: 1024px)').matches;
    }

    function openMobileSidebar() {
        sidebar?.classList.remove('-translate-x-full');
        sidebar?.classList.add('translate-x-0');
        overlay?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
    }

    function closeMobileSidebar() {
        sidebar?.classList.add('-translate-x-full');
        sidebar?.classList.remove('translate-x-0');
        overlay?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
    }

    function toggleMobileSidebar() {
        if (sidebar?.classList.contains('-translate-x-full')) {
            openMobileSidebar();
        } else {
            closeMobileSidebar();
        }
    }

    function setCollapsed(collapsed) {
        sidebar?.classList.toggle('lg:w-20', collapsed);
        sidebar?.classList.toggle('lg:w-64', !collapsed);
        mainContent?.classList.toggle('lg:pl-20', collapsed);
        mainContent?.classList.toggle('lg:pl-64', !collapsed);
        document.body.classList.toggle('sidebar-collapsed', collapsed);
        localStorage.setItem(STORAGE_SIDEBAR, collapsed ? '1' : '0');
    }

    function toggleCollapse() {
        setCollapsed(!document.body.classList.contains('sidebar-collapsed'));
    }

    // Đồng bộ trạng thái collapsed theo viewport:
    // - Mobile: bỏ collapsed để menu hiển thị đầy đủ (không ghi đè preference)
    // - Desktop: khôi phục collapsed nếu đã lưu
    function syncCollapsedWithViewport() {
        if (isDesktop()) {
            if (localStorage.getItem(STORAGE_SIDEBAR) === '1' && !document.body.classList.contains('sidebar-collapsed')) {
                setCollapsed(true);
            }
        } else if (document.body.classList.contains('sidebar-collapsed')) {
            document.body.classList.remove('sidebar-collapsed');
            sidebar?.classList.remove('lg:w-20');
            sidebar?.classList.add('lg:w-64');
            mainContent?.classList.remove('lg:pl-20');
            mainContent?.classList.add('lg:pl-64');
        }
    }

    // Khôi phục trạng thái collapse đã lưu (chỉ áp dụng trên desktop)
    if (localStorage.getItem(STORAGE_SIDEBAR) === '1' && isDesktop()) {
        setCollapsed(true);
    }

    window.addEventListener('resize', syncCollapsedWithViewport);

    /* =========================================================
     * Dropdown (user menu, notifications)
     * ========================================================= */
    function initDropdowns() {
        document.querySelectorAll('[data-dropdown]').forEach((trigger) => {
            const menu = document.getElementById(trigger.dataset.dropdown);
            if (!menu) return;

            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = !menu.classList.contains('hidden');
                closeAllDropdowns();
                if (!isOpen) {
                    menu.classList.remove('hidden');
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('[data-dropdown]') && !e.target.closest('[data-dropdown-menu]')) {
                closeAllDropdowns();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeAllDropdowns();
            }
        });
    }

    function closeAllDropdowns() {
        document.querySelectorAll('[data-dropdown-menu]').forEach((menu) => {
            menu.classList.add('hidden');
        });
        document.querySelectorAll('[data-dropdown]').forEach((trigger) => {
            trigger.setAttribute('aria-expanded', 'false');
        });
    }

    /* =========================================================
     * Global search
     * ========================================================= */
    function initSearch() {
        const input = document.getElementById('global-search');
        const panel = document.getElementById('search-results');
        const indexEl = document.getElementById('search-index');
        if (!input || !panel || !indexEl) return;

        let items = [];
        try {
            items = JSON.parse(indexEl.textContent || '[]');
        } catch (err) {
            items = [];
        }

        function render(query) {
            const q = query.trim().toLowerCase();
            const filtered = q
                ? items.filter((item) =>
                      `${item.label} ${item.keywords ?? ''}`.toLowerCase().includes(q),
                  )
                : items.slice(0, 6);

            if (filtered.length === 0) {
                panel.innerHTML =
                    '<div class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">Không tìm thấy kết quả phù hợp</div>';
            } else {
                panel.innerHTML = filtered
                    .map(
                        (item) => `
                        <a href="${item.url}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800">
                            <span class="flex h-8 w-8 items-center justify-center rounded-md bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                                ${item.icon ?? ''}
                            </span>
                            <span>${item.label}</span>
                        </a>`,
                    )
                    .join('');
            }
            panel.classList.remove('hidden');
        }

        function hide() {
            panel.classList.add('hidden');
        }

        input.addEventListener('focus', () => render(input.value));
        input.addEventListener('input', () => render(input.value));
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                hide();
                input.blur();
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#global-search-wrap')) {
                hide();
            }
        });

        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                input.focus();
                input.select();
            }
        });
    }

    /* =========================================================
     * Wire up
     * ========================================================= */
    document.addEventListener('DOMContentLoaded', () => {
        applyTheme(getInitialTheme());

        document.getElementById('theme-toggle')?.addEventListener('click', toggleTheme);
        document.getElementById('sidebar-toggle')?.addEventListener('click', toggleMobileSidebar);
        document.getElementById('sidebar-collapse')?.addEventListener('click', toggleCollapse);
        overlay?.addEventListener('click', closeMobileSidebar);

        initDropdowns();
        initSearch();
    });
})();
