/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/filmeventreservation.js ***!
  \**********************************************/
(function () {
  var input = document.querySelector('input[name=seats]');
  var seatIDs = [];

  if (input == null) {
    console.log('input not found');
    return;
  }

  var seats = document.querySelectorAll('.seat');
  seats.forEach(function (seat) {
    seat.addEventListener('click', function (e) {
      toggleSeat(seat);
    });
  });

  var toggleSeat = function toggleSeat(seat) {
    var id = seat.getAttribute('data-seat-id');
    seat.classList.toggle('selected');
    var index = seatIDs.indexOf(id);

    if (index > -1) {
      seatIDs.splice(index, 1);
    } else {
      seatIDs.push(id);
    }

    input.value = seatIDs;
  };
})();
/******/ })()
;