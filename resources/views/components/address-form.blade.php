
{{-- <div class="field">
    <label class="label" for="firstname">Voornaam</label>

    <div class="control">
        <input class="input" type="text" name="firstname" id="firstname" value="" required>
    </div>

    @error('firstname')
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="lastname">Achternaam</label>

    <div class="control">
        <input class="input" type="text" name="lastname" id="lastname" value="" required>
    </div>

    @error('lastname')
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="email">E-mail</label>

    <div class="control">
        <input class="input" type="email" name="email" id="email" value="" required>
    </div>

    @error('email')
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="phonenumber">Telefoon</label>

    <div class="control">
        <input class="input" type="tel" name="phonenumber" id="phonenumber" value="" required>
    </div>

    @error('phonenumber')
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>   --}}

<div class="field">
    <label class="label" for="postal_code">Postcode</label>

    <div class="control">
        <input class="input" type="text" name="postal_code" id="postal_code" value="" required>
    </div>

    @error('postal_code')
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="street_name">Straatnaam</label>

    <div class="control">
        <input class="input" type="text" name="street_name" id="street_name" value="" required>
    </div>

    @error('street_name')
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="house_number">Huisnummer</label>

    <div class="control">
        <input class="input" type="text" name="house_number" id="house_number" value="" required>
    </div>

    @error('house_number')
        <p class="help is-danger">The given housenumber is not a valid format</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="city">Plaatsnaam</label>

    <div class="control">
        <input class="input" type="text" name="city" id="city" value="" required>
    </div>

    @error('city')
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>

<div class="field">
    <label class="label" for="country">Land</label>

    <div class="control">
        <input class="input" type="text" name="country" id="country" value="" required>
    </div>

    @error('country')
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>
