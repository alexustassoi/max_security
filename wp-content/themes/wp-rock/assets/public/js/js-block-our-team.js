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
/*!*********************************************!*\
  !*** ./src/js/acf-blocks/block-our-team.ts ***!
  \*********************************************/
__webpack_require__.r(__webpack_exports__);
var _a;
var initBlockOurTeam = function initBlockOurTeam() {
  var memberItem = document.querySelectorAll('.js-member-item');
  memberItem && memberItem.forEach(function (item) {
    var member = item;
    member.addEventListener('click', function () {
      return member.classList.toggle('opened');
    });
  });
};
document.addEventListener('DOMContentLoaded', initBlockOurTeam, false);
if (window['acf']) {
  (_a = window['acf']) === null || _a === void 0 ? void 0 : _a.addAction('render_block_preview', initBlockOurTeam);
}

/******/ })()
;
//# sourceMappingURL=js-block-our-team.js.map