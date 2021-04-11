/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/filmeventreservation.js ***!
  \**********************************************/
(function () {
  var seatIDs = [];

  var getLeftSeat = function getLeftSeat(seat) {
    var leftID = parseInt(seat.getAttribute('data-seat-id')) - 1;
    return document.querySelector(".seat[data-seat-id=\"".concat(leftID, "\"]"));
  };

  var getRightSeat = function getRightSeat(seat) {
    var rightID = parseInt(seat.getAttribute('data-seat-id')) + 1;
    return document.querySelector(".seat[data-seat-id=\"".concat(rightID, "\"]"));
  };

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
    var leftSeat = getLeftSeat(seat);

    if (leftSeat == null) {
      return;
    } // check if the left seat is not in the same row


    if (leftSeat.parentElement !== seat.parentElement) {
      return;
    } // disable or enable the seat


    leftSeat.disabled = !leftSeat.disabled;
    leftSeat.classList.toggle('disabled');
  };

  var toggleRightSeat = function toggleRightSeat(seat) {
    var rightSeat = getRightSeat(seat);

    if (rightSeat == null) {
      return;
    } // check if the right seat is not in the same row


    if (rightSeat.parentElement !== seat.parentElement) {
      return;
    } // disable or enable the seat


    rightSeat.disabled = !rightSeat.disabled;
    rightSeat.classList.toggle('disabled');
  };

  var input = document.querySelector('input[name=seats]');

  if (input == null) {
    console.log('input not found');
    return;
  }

  var seats = document.querySelectorAll('.seat');
  seats.forEach(function (seat) {
    // check if the seat is already reserved
    if (seat.classList.contains('reserved')) {
      seat.disabled = true;
      toggleLeftSeat(seat);
      toggleRightSeat(seat);
    }

    seat.addEventListener('click', function (e) {
      // check if the seat or a seat next to the seat is disabled
      if (!seat.classList.contains('selected') && (seat.disabled || getLeftSeat(seat).disabled || getRightSeat(seat).disabled)) {
        return;
      }

      toggleSeat(seat);
    });
  });
})();
/******/ })()
;