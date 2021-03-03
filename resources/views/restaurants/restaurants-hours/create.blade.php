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
                    @foreach(array_keys($openinghours) as $key)
                        <tr> 
                            <td>{{$key}}</td>
                            <td>
                                <input 
                                    class="input"
                                    type="time"
                                    name="openinghour{{$key}}" 
                                    id="openinghour{{$key}}"
                                    value={{$openinghours[$key]['openinghour']}}
                                    required>
                            </td>
                            <td>
                                <input 
                                    class="input"
                                    type="time"
                                    name="closinghour{{$key}}" 
                                    id="closinghour{{$key}}"
                                    value={{$openinghours[$key]['closinghour']}}
                                    required>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>