(function(){"use strict";var __webpack_require__={};!function(){__webpack_require__.r=function(exports){if(typeof Symbol!=='undefined'&&Symbol.toStringTag){Object.defineProperty(exports,Symbol.toStringTag,{value:'Module'})}Object.defineProperty(exports,'__esModule',{value:!0})}}();var __webpack_exports__={};
/*!*********************************************!*\
  !*** ./src/js/acf-blocks/block-our-team.ts ***!
  \*********************************************/
__webpack_require__.r(__webpack_exports__);var _a;var initBlockOurTeam=function initBlockOurTeam(){var memberItem=document.querySelectorAll('.js-member-item');memberItem&&memberItem.forEach(function(item){var member=item;member.addEventListener('click',function(){return member.classList.toggle('opened')})})};document.addEventListener('DOMContentLoaded',initBlockOurTeam,!1);if(window.acf){(_a=window.acf)===null||_a===void 0?void 0:_a.addAction('render_block_preview',initBlockOurTeam)}})()
;