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
/*!****************************************!*\
  !*** ./src/js/acf-blocks/block-faq.ts ***!
  \****************************************/
__webpack_require__.r(__webpack_exports__);
var _a;
var handleFaqItem = function handleFaqItem() {
  document.body.addEventListener('click', function (e) {
    var target = e.target;
    var role = target.dataset.role;
    if (!role) return;
    switch (role) {
      case 'handle-faq-item':
        {
          e.preventDefault();
          var parentFaqItem = target.closest('.js-faq-item');
          if (!parentFaqItem) return;
          var actionType = parentFaqItem.classList.contains('active') ? 'remove' : 'add';
          parentFaqItem.classList[actionType]('active');
          break;
        }
      default:
        break;
    }
  });
};
document.addEventListener('DOMContentLoaded', handleFaqItem, false);
if (window['acf']) {
  (_a = window['acf']) === null || _a === void 0 ? void 0 : _a.addAction('render_block_preview', handleFaqItem);
}

/******/ })()
;
//# sourceMappingURL=js-block-faq.js.map