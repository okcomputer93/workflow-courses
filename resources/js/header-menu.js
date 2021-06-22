const menuOpen = document.getElementById('menu-open');
const menuClose = document.getElementById('menu-close');
const menu = document.getElementById('menu');

const closeMenu = () => {
    menu.classList.replace('translate-x-0', '-translate-x-full');
    window.removeEventListener('click', clickOutside);
}

const openMenu = () => {
    menu.classList.replace('-translate-x-full', 'translate-x-0');
}

const clickOutside = (e) => {
    const openedMenu = e.target.closest('#menu');
    if (openedMenu) return;
    closeMenu();
}

menuOpen.addEventListener('click', (e) => {
    e.stopPropagation();
    openMenu();
    window.addEventListener('click', clickOutside);
});

menuClose.addEventListener('click', closeMenu);
