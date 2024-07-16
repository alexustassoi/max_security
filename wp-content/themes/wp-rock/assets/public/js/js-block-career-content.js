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
/*!***************************************************!*\
  !*** ./src/js/acf-blocks/block-career-content.ts ***!
  \***************************************************/
__webpack_require__.r(__webpack_exports__);
var _a;
var initBlockCareerContent = function initBlockCareerContent() {
  var file = document.querySelector('.js-file-button input[type="file"]');
  if (file) {
    file.onchange = function () {
      var fileNameSpan = document.querySelector('.js-file-name');
      if (fileNameSpan && file.files && file.files[0]) {
        fileNameSpan.innerHTML = file === null || file === void 0 ? void 0 : file.files[0].name;
      }
    };
  }
};
document.addEventListener('DOMContentLoaded', initBlockCareerContent, false);
if (window['acf']) {
  (_a = window['acf']) === null || _a === void 0 ? void 0 : _a.addAction('render_block_preview', initBlockCareerContent);
}

/******/ })()
;
//# sourceMappingURL=js-block-career-content.js.map