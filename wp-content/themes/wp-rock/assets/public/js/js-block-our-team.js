/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
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