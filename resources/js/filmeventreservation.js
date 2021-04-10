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
    };
})();
