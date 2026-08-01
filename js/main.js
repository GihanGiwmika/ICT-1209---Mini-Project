
//--------------------Index Form Register And Login Button js-----------------------------------
const loginTab = document.getElementById('login-tab');
const registerTab = document.getElementById('register-tab');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

if (registerTab && loginTab && loginForm && registerForm){

// Register Tab Click 
registerTab.addEventListener('click', () => {
    loginTab.classList.remove('active');
    loginTab.classList.add('inactive');
    registerTab.classList.add('active');
    registerTab.classList.remove('inactive');

    loginForm.classList.add('d-none');
    registerForm.classList.remove('d-none');
});

// Login Tab Click 
loginTab.addEventListener('click', () => {
    registerTab.classList.remove('active');
    registerTab.classList.add('inactive');
    loginTab.classList.add('active');
    loginTab.classList.remove('inactive');

    registerForm.classList.add('d-none');
    loginForm.classList.remove('d-none');
});
}

//-----------------User Authendication & Header Display System----------------------------------

function updateHeaderUser() {
    const userBtn = document.getElementById('user-nav-btn');
    const savedUser = localStorage.getItem('techquiz_user');

    if (userBtn && savedUser) {
        userBtn.innerText = savedUser;
        userBtn.href = "#";
    }
}


if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const usernameInput = document.getElementById('login-username');
        if (usernameInput && usernameInput.value.trim() !== "") {
            const username = usernameInput.value.trim();

        
            localStorage.setItem('techquiz_user', username);

        
            updateHeaderUser();

            alert(`Welcome back, ${username}!`);
            loginForm.reset();
        }
    });
}


document.addEventListener('DOMContentLoaded', () => {
    updateHeaderUser();
});