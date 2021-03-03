<div class="container">
    <div class="field">
        <label class="label" for="name">Openingstijden</label>

        <div class="control">
            <table class="table">
                <thead>
                    <tr>
                        <th>Dag</th>
                        <th>Opent om</th>
                        <th>Sluit om</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($openingtimes as $day)
                        <tr> 
                            <td>{{$day->weekday}}</td>
                            <td>
                                <input 
                                    class="input"
                                    type="time"
                                    name="openinghour{{$day->weekday}}" 
                                    id="openinghour{{$day->weekday}}"
                                    value={{$day->openingtime}}
                                    required>
                            </td>
                            <td>
                                <input 
                                    class="input"
                                    type="time"
                                    name="closinghour{{$day->weekday}}" 
                                    id="closinghour{{$day->weekday}}"
                                    value={{$day->closingtime}}
                                    required>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>