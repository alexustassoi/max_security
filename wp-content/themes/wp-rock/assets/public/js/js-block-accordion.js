/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
var _a;
var initBlockBenefts = function initBlockBenefts() {
  var customCheckboxes = document.querySelectorAll('.js-custom-checkbox');
  var scrollToElement = function scrollToElement() {
    var urlParams = new URLSearchParams(window.location.search);
    console.log(urlParams.get('from-page'));
    var accrodionToOpen = document.querySelector("#".concat(urlParams.get('from-page')));
    if (accrodionToOpen) {
      accrodionToOpen.classList.add('open');
      window.scrollTo({
        top: accrodionToOpen.offsetTop - 100,
        behavior: 'smooth'
      });
    }
  };
  scrollToElement();
  var setHiddenInput = function setHiddenInput(e) {
    var input = e.target;
    if (input.checked) {
      var hiddenInput = document.createElement('input');
      var form = document.querySelector('form');
      hiddenInput.type = 'hidden';
      hiddenInput.name = input.name;
      hiddenInput.value = input.value;
      form && form.appendChild(hiddenInput);
    } else {
      var findedHiddenInput = document.querySelector("form [name=\"".concat(input.name, "\"]"));
      findedHiddenInput && findedHiddenInput.remove();
    }
  };
  customCheckboxes && customCheckboxes.forEach(function (input) {
    input.addEventListener('change', setHiddenInput);
  });
};
document.addEventListener('DOMContentLoaded', initBlockBenefts, false);
if (window['acf']) {
  (_a = window['acf']) === null || _a === void 0 ? void 0 : _a.addAction('render_block_preview', initBlockBenefts);
}

/******/ })()
;