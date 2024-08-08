/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
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