(() => {
    const input = document.querySelector('input[name=seats]');
    let seatIDs = [];

    if (input == null) {
        console.log('input not found');
        return;
    }

    let seats = document.querySelectorAll('.seat');

    seats.forEach(seat => {
        seat.addEventListener('click', (e) => {
            if (seat.disabled) {
                return;
            }

            toggleSeat(seat);
        });
    });

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
        let leftID = parseInt(seat.getAttribute('data-seat-id')) - 1;
        let leftSeat = document.querySelector(`.seat[data-seat-id="${leftID}"]`);

        if (leftSeat == null) {
            return;
        }

        // check if the left seat is in the same row
        if (leftSeat.parentElement === seat.parentElement) {
            leftSeat.disabled = !leftSeat.disabled;
            leftSeat.classList.toggle('disabled');
        }
    };

    const toggleRightSeat = (seat) => {
        let rightID = parseInt(seat.getAttribute('data-seat-id')) + 1;
        let rightSeat = document.querySelector(`.seat[data-seat-id="${rightID}"]`);

        if (rightSeat == null) {
            return;
        }

        // check if the right seat is in the same row
        if (rightSeat.parentElement === seat.parentElement) {
            rightSeat.disabled = !rightSeat.disabled;
            rightSeat.classList.toggle('disabled');
        }
    };
})();
