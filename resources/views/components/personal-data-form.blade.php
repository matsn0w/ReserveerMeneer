
<div class="field">
    <label class="label" for="firstname">Voornaam</label>

    <div class="control">
        <input class="input" type="text" name="firstname" id="firstname" value="" required>
    </div>

    @error('firstname')
        <p class="help is-danger">{{$message}}</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="lastname">Achternaam</label>

    <div class="control">
        <input class="input" type="text" name="lastname" id="lastname" value="" required>
    </div>

    @error('lastname')
        <p class="help is-danger">{{$message}}</p>
    @enderror
</div>            

<div class="field">
    <label class="label" for="email">E-mail</label>

    <div class="control">
        <input class="input" type="email" name="email" id="email" value="" required>
    </div>

    @error('email')
        <p class="help is-danger">{{$message}}</p>
    @enderror
</div>            

<div class="field">
    <label class="label" for="phonenumber">Telefoon</label>

    <div class="control">
        <input class="input" type="tel" name="phonenumber" id="phonenumber" value="" required>
    </div>

    @error('phonenumber')
        <p class="help is-danger">{{$message}}</p>
    @enderror
</div>  

<div class="field">
    <label class="label" for="postalcode">Postcode</label>

    <div class="control">
        <input class="input" type="text" name="postalcode" id="postalcode" value="" required>
    </div>

    @error('postalcode')
        <p class="help is-danger">{{$message}}</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="housenumber">Huisnummer</label>

    <div class="control">
        <input class="input" type="text" name="housenumber" id="housenumber" value="" required>
    </div>

    @error('housenumber')
        <p class="help is-danger">{{$message}}</p>
    @enderror
</div>

