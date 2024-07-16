/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
var initBlockExample = function initBlockExample() {
  var scrollBottom = document.querySelector('.js-scroll-bottom');
  scrollBottom === null || scrollBottom === void 0 ? void 0 : scrollBottom.addEventListener('click', function (event) {
    event.preventDefault();
    var target = event.target;
    var parent = target.closest('.js-top-block');
    if (parent) {
      var height = parent.offsetHeight;
      window.scrollBy({
        top: height - 50,
        behavior: 'smooth'
      });
    }
  });
};
document.addEventListener('DOMContentLoaded', initBlockExample, false);

/******/ })()
;