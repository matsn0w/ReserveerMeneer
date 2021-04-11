<div class="block seats">
    @php $counter = 1; @endphp

    @foreach ($hall->seats->chunk($hall->seatsPerRow) as $row)
        <div class="row">
            <p>Rij {{ $counter++ }}</p>

            @foreach ($row as $seat)
                <div class="seat @if (in_array($seat->id, $reserved)) reserved @endif" data-seat-id="{{ $seat->id }}">{{ $seat->number }}</div>
            @endforeach
        </div>
    @endforeach
</div>
