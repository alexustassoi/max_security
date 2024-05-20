/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./src/js/acf-blocks/block-accordion.ts ***!
  \**********************************************/
__webpack_require__.r(__webpack_exports__);
var _a;
var initBlockBenefts = function initBlockBenefts() {
  var customCheckboxes = document.querySelectorAll(".js-custom-checkbox");
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
if (window['acf']) {
  (_a = window['acf']) === null || _a === void 0 ? void 0 : _a.addAction('render_block_preview', initBlockBenefts);
}

/******/ })()
;
//# sourceMappingURL=js-block-accordion.js.map