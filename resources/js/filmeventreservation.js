(() => {
    let seatIDs = [];

    const getLeftSeat = (seat) => {
        let leftID = parseInt(seat.getAttribute('data-seat-id')) - 1;
        return document.querySelector(`.seat[data-seat-id="${leftID}"]`);
    };

    const getRightSeat = (seat) => {
        let rightID = parseInt(seat.getAttribute('data-seat-id')) + 1;
        return document.querySelector(`.seat[data-seat-id="${rightID}"]`);
    };

    const toggleSeat = (seat) => {
        let id = seat.getAttribute('data-seat-id');

        seat.classList.toggle('selected');

        const index = seatIDs.indexOf(id);

        if (index > -1) {
            seatIDs.splice(index, 1);
        } else {
            seatIDs.push(id);
        }

        input.value = seatIDs;

        toggleLeftSeat(seat);
        toggleRightSeat(seat);
    };

    const toggleLeftSeat = (seat) => {
        let leftSeat = getLeftSeat(seat);

        if (leftSeat == null) {
            return;
        }

        // check if the left seat is not in the same row
        if (leftSeat.parentElement !== seat.parentElement) {
            return;
        }

        // check if the left seat is disabled because of a selected or reserved seat
        leftLeftSeat = getLeftSeat(leftSeat);

        if (leftLeftSeat?.classList.contains('selected') || leftLeftSeat?.classList.contains('reserved')) {
            return;
        }

        // disable or enable the seat
        leftSeat.disabled = !leftSeat.disabled;
        leftSeat.classList.toggle('disabled');
    };

    const toggleRightSeat = (seat) => {
        let rightSeat = getRightSeat(seat);

        if (rightSeat == null) {
            return;
        }

        // check if the right seat is not in the same row
        if (rightSeat.parentElement !== seat.parentElement) {
            return;
        }

        // check if the right seat is disabled because of a selected or reserved seat
        rightRightSeat = getRightSeat(rightSeat);

        if (rightRightSeat?.classList.contains('selected') || rightRightSeat?.classList.contains('reserved')) {
            return;
        }

        // disable or enable the seat
        rightSeat.disabled = !rightSeat.disabled;
        rightSeat.classList.toggle('disabled');
    };

    const input = document.querySelector('input[name=seats]');

    if (input == null) {
        console.log('input not found');
        return;
    }

    let seats = document.querySelectorAll('.seat');

    seats.forEach(seat => {
        // check if the seat is already reserved
        if (seat.classList.contains('reserved')) {
            seat.disabled = true;
            toggleLeftSeat(seat);
            toggleRightSeat(seat);
        }

        seat.addEventListener('click', (e) => {
            // check if the seat is disabled
            if (!seat.classList.contains('selected') && seat.disabled) {
                return;
            }

            toggleSeat(seat);
        });
    });
})();
