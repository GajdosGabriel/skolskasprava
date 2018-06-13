


    @include('moduls.errors')
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text {{ $errors->has('first_name') ? ' has-error' : '' }}" id="meno">Meno</span>
        </div>
        <input required type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" placeholder="Meno" aria-label="Meno" aria-describedby="meno">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('last_name') ? ' has-error' : '' }}">Priezvisko</div>
        </div>
        <input required type="text" name="last_name" value="{{ $user->last_name }}"class="form-control" placeholder="Priezvisko">
    </div>

    @if(str_contains($user->email, '@'))
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text {{ $errors->has('email') ? ' has-error' : '' }}">Email</div>
            </div>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>
    @else
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text {{ $errors->has('email') ? ' has-error' : '' }}">Email</div>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Email neuvedený">
        </div>
    @endif

    @if($user->hasRole(1))
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text {{ $errors->has('company') ? ' has-error' : '' }}" id="company">Názov firmy</span>
        </div>
        <input type="text" name="company" value="{{ $user->company }}" class="form-control" placeholder="Škola ..." aria-label="company" aria-describedby="company" required>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('ico') ? ' has-error' : '' }}">IČO</div>
        </div>
        <input type="text" name="ico" value="{{ $user->ico }}" class="form-control" placeholder="IČO organizácie">
    </div>
    @endif


    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('street') ? ' has-error' : '' }}">Ulica a číslo</div>
        </div>
        <input required type="text" name="street" value="{{ $user->street }}" class="form-control" placeholder="Ulica a číslo">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('city') ? ' has-error' : '' }}">Mesto</div>
        </div>
        <input required type="text" name="city" value="{{ $user->city }}" class="form-control" placeholder="Mesto">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('psc') ? ' has-error' : '' }}">Psč</div>
        </div>
        <input required type="text" name="psc" value="{{ $user->psc }}" class="form-control" placeholder="Psč">
    </div>

    <div class="footer">
        @can('admin-edit')
        <a Onclick="return ConfirmDelete()" href="{{ route('worker.destroy', [ $user->id, $user->slug ]) }}" onclick="get_form(this).submit(); return false">Zmazať</a>
        @endcan
        <button class="btn btn-primary pull-right">Uložiť</button>
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary pull-right">Späť</a>
    </div>


