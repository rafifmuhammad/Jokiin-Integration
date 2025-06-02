const menuNav = document.querySelector('.menu-navigation');
const menuBar = document.querySelector('.menu-bar');
const headerShrink = document.querySelector('.header');
const dashboardContentShrink = document.querySelector('.dashboard-content');
const contentShrink = document.querySelector('.content');
const formContentShrink = document.querySelector('.form-content');
const footerShrink = document.querySelector('.footer');
const openModal = document.querySelector('.open-modal');
const modalAlert = document.querySelector('.modal-alert');
const closeModal = document.querySelector('.close-modal');

// Navigation
menuBar.addEventListener('click', () => {
    menuNav.classList.toggle('menu-active');
    if (headerShrink) headerShrink.classList.toggle('shrink');
    if (dashboardContentShrink) dashboardContentShrink.classList.toggle('shrink');
    if (contentShrink) contentShrink.classList.toggle('shrink');
    if (formContentShrink) formContentShrink.classList.toggle('shrink');
    if (footerShrink) footerShrink.classList.toggle('shrink');
});


// Modal Error

openModal.addEventListener('click', () => {
    if (modalAlert) modalAlert.classList.toggle('modal-active');
});