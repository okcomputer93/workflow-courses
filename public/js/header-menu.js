/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/header-menu.js ***!
  \*************************************/
var menuOpen = document.getElementById('menu-open');
var menuClose = document.getElementById('menu-close');
var menu = document.getElementById('menu');

var closeMenu = function closeMenu() {
  menu.classList.replace('translate-x-0', '-translate-x-full');
  window.removeEventListener('click', clickOutside);
};

var openMenu = function openMenu() {
  menu.classList.replace('-translate-x-full', 'translate-x-0');
};

var clickOutside = function clickOutside(e) {
  var openedMenu = e.target.closest('#menu');
  if (openedMenu) return;
  closeMenu();
};

menuOpen.addEventListener('click', function (e) {
  e.stopPropagation();
  openMenu();
  window.addEventListener('click', clickOutside);
});
menuClose.addEventListener('click', closeMenu);
/******/ })()
;