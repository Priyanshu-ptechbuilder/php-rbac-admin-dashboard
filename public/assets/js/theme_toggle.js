// public/assets/js/theme_toggle.js

(function() {
    const themeToggleBtn = document.getElementById('kt_theme_toggle');
    const themeBtns = document.querySelectorAll('.theme-toggle-btn');
    
    function setTheme(theme) {
        localStorage.setItem('theme', theme);
        document.cookie = "theme=" + theme + "; path=/; max-age=" + (365 * 24 * 60 * 60);
        location.reload(); 
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const currentTheme = localStorage.getItem('theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            setTheme(newTheme);
        });
    }

    themeBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const theme = btn.getAttribute('data-theme');
            setTheme(theme);
        });
    });

    const menuToggle = document.getElementById('kt_user_menu_dark_mode_toggle');
    if (menuToggle) {
        menuToggle.addEventListener('change', () => {
            const newTheme = menuToggle.checked ? 'dark' : 'light';
            setTheme(newTheme);
        });
    }

    // Password visibility toggle logic
    document.addEventListener('click', function(e) {
        const toggleBtn = e.target.closest('.password-toggle-btn');
        if (toggleBtn) {
            e.preventDefault();
            const inputGroup = toggleBtn.closest('.password-input-group');
            if (inputGroup) {
                const input = inputGroup.querySelector('input');
                if (input) {
                    if (input.type === 'password') {
                        input.type = 'text';
                        toggleBtn.innerHTML = '👁️'; 
                    } else {
                        input.type = 'password';
                        toggleBtn.innerHTML = '👁️‍🗨️'; 
                    }
                }
            }
        }
    });

})();
