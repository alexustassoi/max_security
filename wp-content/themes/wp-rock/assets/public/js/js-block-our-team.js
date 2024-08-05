/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
var _a;
var initBlockOurTeam = function initBlockOurTeam() {
  var memberItem = document.querySelectorAll('.js-member-item');
  var body = window.document.querySelector('body');
  var html = window.document.querySelector('html');
  memberItem && memberItem.forEach(function (item) {
    var member = item;
    if (window.innerWidth > 680) {
      member.addEventListener('click', function () {
        return member.classList.toggle('opened');
      });
    } else {
      member.addEventListener('click', function (event) {
        var target = event.target;
        if (target.classList.contains('js-member-item-btn')) {
          member.classList.remove('opened');
          body.classList.remove('scroll-off');
          html.classList.remove('scroll-off');
        } else {
          member.classList.add('opened');
          body.classList.add('scroll-off');
          html.classList.add('scroll-off');
        }
      });
    }
  });
};
document.addEventListener('DOMContentLoaded', initBlockOurTeam, false);
if (window['acf']) {
  (_a = window['acf']) === null || _a === void 0 ? void 0 : _a.addAction('render_block_preview', initBlockOurTeam);
}

/******/ })()
;