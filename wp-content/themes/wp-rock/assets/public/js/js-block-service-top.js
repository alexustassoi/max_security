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
/*!************************************************!*\
  !*** ./src/js/acf-blocks/block-service-top.ts ***!
  \************************************************/
__webpack_require__.r(__webpack_exports__);
var initBlockExample = function initBlockExample() {
  console.log('asd');
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
//# sourceMappingURL=js-block-service-top.js.map