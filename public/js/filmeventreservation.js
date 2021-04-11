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
      if (seat.disabled) {
        return;
      }

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
    toggleLeftSeat(seat);
    toggleRightSeat(seat);
  };

  var toggleLeftSeat = function toggleLeftSeat(seat) {
    var leftID = parseInt(seat.getAttribute('data-seat-id')) - 1;
    var leftSeat = document.querySelector(".seat[data-seat-id=\"".concat(leftID, "\"]"));

    if (leftSeat == null) {
      return;
    } // check if the left seat is in the same row


    if (leftSeat.parentElement === seat.parentElement) {
      leftSeat.disabled = !leftSeat.disabled;
      leftSeat.classList.toggle('disabled');
    }
  };

  var toggleRightSeat = function toggleRightSeat(seat) {
    var rightID = parseInt(seat.getAttribute('data-seat-id')) + 1;
    var rightSeat = document.querySelector(".seat[data-seat-id=\"".concat(rightID, "\"]"));

    if (rightSeat == null) {
      return;
    } // check if the right seat is in the same row


    if (rightSeat.parentElement === seat.parentElement) {
      rightSeat.disabled = !rightSeat.disabled;
      rightSeat.classList.toggle('disabled');
    }
  };
})();
/******/ })()
;