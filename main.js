
//--------------------Index Form Register And Login Button js-----------------------------------
const loginTab = document.getElementById('login-tab');
const registerTab = document.getElementById('register-tab');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

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



