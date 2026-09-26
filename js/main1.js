// Tab Switching
const loginTab = document.getElementById('login-tab');
const registerTab = document.getElementById('register-tab');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

if (registerTab && loginTab && loginForm && registerForm) {
    // Show register form
    registerTab.addEventListener('click', () => {
        loginTab.classList.remove('active');
        loginTab.classList.add('inactive');
        registerTab.classList.add('active');
        registerTab.classList.remove('inactive');

        loginForm.classList.add('d-none');
        registerForm.classList.remove('d-none');
    });

    // Show login form
    loginTab.addEventListener('click', () => {
        registerTab.classList.remove('active');
        registerTab.classList.add('inactive');
        loginTab.classList.add('active');
        loginTab.classList.remove('inactive');

        registerForm.classList.add('d-none');
        loginForm.classList.remove('d-none');
    });
}

// User Header and Dropdown
function updateHeaderUser() {
    const userBtn = document.getElementById('user-nav-btn');
    if (!userBtn) return;

    const savedUser = localStorage.getItem('techquiz_user');

    if (savedUser) {
        userBtn.innerHTML = `👤 ${savedUser} <span style="font-size: 0.7rem; margin-left: 4px;">▼</span>`;
        userBtn.href = "javascript:void(0);";

        let wrapper = userBtn.parentElement;
        if (!wrapper.classList.contains('user-dropdown')) {
            wrapper = document.createElement('div');
            wrapper.className = 'user-dropdown';
            userBtn.parentNode.insertBefore(wrapper, userBtn);
            wrapper.appendChild(userBtn);
        }

        let dropdown = document.getElementById('user-dropdown-menu');
        if (!dropdown) {
            dropdown = document.createElement('div');
            dropdown.id = 'user-dropdown-menu';
            dropdown.className = 'dropdown-menu-custom';
            dropdown.innerHTML = `<div class="dropdown-item-custom" id="logout-btn">🚪 Logout</div>`;
            wrapper.appendChild(dropdown);

            document.getElementById('logout-btn').addEventListener('click', () => {
                localStorage.removeItem('techquiz_user');
                alert('Successfully Logged Out!');
                window.location.reload();
            });
        }

        userBtn.onclick = (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('show');
        };

    } else {
        userBtn.innerText = "Sign In";
        userBtn.href = "#auth-section";
        userBtn.onclick = null;

        const dropdown = document.getElementById('user-dropdown-menu');
        if (dropdown) dropdown.remove();
    }
}

// Close Dropdown on outside click
document.addEventListener('click', () => {
    const dropdown = document.getElementById('user-dropdown-menu');
    if (dropdown) dropdown.classList.remove('show');
});

// Page Load Handling
document.addEventListener('DOMContentLoaded', () => {
    updateHeaderUser();

    // Auto hide toast message
    const toast = document.getElementById('status-toast');
    if (toast) {
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }

    // Keep login form active after register
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('register') === 'success' && loginTab) {
        loginTab.click();
    }
});



// Auto-hide Top Toast Notification (Contact from)
document.addEventListener('DOMContentLoaded', () => {
    const toast = document.getElementById('status-toast');
    if (toast) {
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translate(-50%, -20px)';
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }
});