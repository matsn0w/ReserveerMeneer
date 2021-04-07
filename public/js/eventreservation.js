/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/eventreservation.js ***!
  \******************************************/
var select = document.querySelector('select#tickettype');
select.selectedIndex = -1;
var eventstart = new Date(document.querySelector('input#startdate').min);
var eventend = new Date(document.querySelector('input#startdate').max);
select.addEventListener('change', function () {
  var startinput = document.querySelector('input#startdate');
  var endinput = document.querySelector('input#enddate');
  var enddisplay = document.querySelector('input#enddate_display');
  startinput.value = getDateString(eventstart);

  switch (select.value) {
    case '1':
      startinput.min = getDateString(eventstart);
      startinput.max = getDateString(eventend);
      startinput.disabled = false;
      endinput.value = getDateString(getNewDate(eventstart, 1));
      enddisplay.value = endinput.value;
      break;

    case '2':
      startinput.min = getDateString(eventstart);
      startinput.max = getDateString(getNewDate(eventend, -1));
      startinput.disabled = false;
      endinput.value = getDateString(getNewDate(eventstart, 2));
      enddisplay.value = endinput.value;
      break;

    case 'full':
      startinput.min = getDateString(eventstart);
      startinput.max = getDateString(eventstart);
      startinput.disabled = true;
      endinput.value = getDateString(eventend);
      enddisplay.value = endinput.value;
      break;
  }
});

function getDateString(date) {
  var str = "".concat(date.getFullYear(), "-");
  if (date.getMonth() + 1 < 10) str = str + '0';
  str = str + "".concat(date.getMonth() + 1, "-");
  if (date.getDate() < 10) str = str + '0';
  str = str + "".concat(date.getDate());
  return str;
}

function getNewDate(date, amountOfDays) {
  var milliseconds = 1000 * 60 * 60 * 24 * amountOfDays;
  var date2 = new Date(date.getTime() + milliseconds);
  return date2;
}
/******/ })()
;