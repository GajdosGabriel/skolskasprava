<div class="card">
    <div class="card-header text-white bg-primary mb-3">{{ __('web.Register') }}
        <a href="{{ URL::previous() }}">
            <span style="color: white; font-size: 150%" class="pull-right">&times;</span></a>
    </div>
    <div class="d-flex">
        <strong class="mx-auto">Zdarma</strong>
    </div>
    <div class="card-body">

        @include('moduls.errors')
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
                <label for="firstName" class="col-md-4 col-form-label text-md-right">{{ __('web.first_name') }}</label>

                <div class="col-md-6">
                    <input placeholder="meno" id="firstName" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="lastName" class="col-md-4 col-form-label text-md-right">{{ __('web.last_name') }}</label>

                <div class="col-md-6">
                    <input placeholder="priezvisko" id="lastName" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>

                    @if ($errors->has('company'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row{{ $errors->has('ico') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 col-form-label text-md-right">IČO</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" maxlength="8" placeholder="ičo organizácie" name="ico"  minlength="8" value="{{ old('ico') }}" required autofocus>

                    @if ($errors->has('ico'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('ico') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('web.E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input placeholder="váš email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('web.Password') }}</label>

                <div class="col-md-6">
                    <input placeholder="min. 6 znakov" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('web.Confirm Password') }}</label>

                <div class="col-md-6">
                    <input placeholder="zopakovať heslo" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="human" class="col-md-4 col-form-label text-md-right">{{ __('web.Iam_human') }}</label>

                <div class="col-md-6">
                    <input type="number" id="human" name="iamHuman" placeholder="Zadajte číslo 5" style="color: black; width: 40%" required>
                    @if ($errors->has('iamHuman'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('iamHuman') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('web.Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>