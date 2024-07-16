/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
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