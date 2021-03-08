<div class="container">
    <div class="field">
        <label class="label" for="name">Openingstijden</label>

        <div class="control">
            <table class="table">
                <thead>
                    <tr>
                        <th>Dag</th>
                        <th>Open</th>
                        <th>Sluit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($openingtimes as $day)
                        <tr>
                            <td>{{$day->weekday}}</td>
                            <td>{{date('H:i', strtotime($day->openingtime))}}</td>
                            <td>{{date('H:i', strtotime($day->closingtime))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>