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
/*!**************************************************!*\
  !*** ./src/js/acf-blocks/block-text-repeater.ts ***!
  \**************************************************/
__webpack_require__.r(__webpack_exports__);
var _a;
var initBlockBenefts = function initBlockBenefts() {
  var beneftsTitle = document.querySelectorAll('.js-benefts-title');
  beneftsTitle && beneftsTitle.forEach(function (item) {
    item.addEventListener('click', function (event) {
      var _a;
      var screenWidth = window.innerWidth;
      var clickElem = event.target;
      clickElem.classList.toggle('open');
      if (screenWidth <= 768) {
        var parent = clickElem.closest('.js-benefts-item');
        (_a = parent.querySelector('.js-benefts-content')) === null || _a === void 0 ? void 0 : _a.classList.toggle('open');
      }
    });
  });
};
document.addEventListener('DOMContentLoaded', initBlockBenefts, false);
if (window['acf']) {
  (_a = window['acf']) === null || _a === void 0 ? void 0 : _a.addAction('render_block_preview', initBlockBenefts);
}

/******/ })()
;
//# sourceMappingURL=js-block-text-repeater.js.map