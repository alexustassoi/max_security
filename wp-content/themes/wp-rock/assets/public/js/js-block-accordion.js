/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
var _a;
var initBlockBenefts = function initBlockBenefts() {
  var customCheckboxes = document.querySelectorAll(".js-custom-checkbox");
  var scrollToElement = function scrollToElement() {
    var urlParams = new URLSearchParams(window.location.search);
    var fromParam = urlParams.get('from-page');
    fromParam = fromParam && fromParam.replace(/^\/+|\/+$/g, '');
    var accordionToOpen = document.querySelector("#".concat(fromParam));
    if (accordionToOpen) {
      accordionToOpen.classList.add('open');
      window.scrollTo({
        top: accordionToOpen.offsetTop - 100,
        behavior: 'smooth'
      });
    }
  };
  scrollToElement();
  var setHiddenInput = function setHiddenInput(e) {
    if (!e.target.dataset.group) return;
    var groupType = e.target.dataset.group;
    var inputOther = document.querySelector("input[name=\"".concat(groupType, "\"]"));
    var allCheckedCheckboxes = [];
    var customCheckboxesGroup = document.querySelectorAll(".js-custom-checkbox[data-group=\"".concat(groupType, "\"]"));
    customCheckboxesGroup && customCheckboxesGroup.forEach(function (el, index) {
      var input = el;
      if (input.checked) {
        var val = input.value;
        allCheckedCheckboxes.push(val);
      }
    });
    if (inputOther) {
      inputOther.value = allCheckedCheckboxes.join(', ');
    }
  };
  customCheckboxes && customCheckboxes.forEach(function (input) {
    input.addEventListener('change', setHiddenInput);
  });
};
document.addEventListener('DOMContentLoaded', initBlockBenefts, false);
if (window === null || window === void 0 ? void 0 : window.acf) {
  (_a = window === null || window === void 0 ? void 0 : window.acf) === null || _a === void 0 ? void 0 : _a.addAction('render_block_preview', initBlockBenefts);
}

/******/ })()
;