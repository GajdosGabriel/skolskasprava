<!-- Modal -->
<div class="modal fade" id="workerStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('worker.store') }}" class="form-inline">
        @csrf

            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pridať učiteľa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-danger {{ $errors->has('first_name') ? ' has-error' : '' }}" id="meno">Meno</span>
                        </div>
                        <input type="text" name="first_name" class="form-control" placeholder="Meno učiteľa" aria-label="Meno" aria-describedby="meno" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger {{ $errors->has('last_name') ? ' has-error' : '' }}">Priezvisko</div>
                        </div>
                        <input type="text" name="last_name" class="form-control" placeholder="Priezvisko učiteľa" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger {{ $errors->has('email') ? ' has-error' : '' }}">Email</div>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email na zaslanie potvrdenia" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text {{ $errors->has('street') ? ' has-error' : '' }}">Ulica a číslo</div>
                        </div>
                        <input type="text" name="street" class="form-control" placeholder="Ulica a číslo">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text {{ $errors->has('city') ? ' has-error' : '' }}">Mesto</div>
                        </div>
                        <input type="text" name="city" class="form-control" placeholder="Mesto">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text {{ $errors->has('psc') ? ' has-error' : '' }}">Psč</div>
                        </div>
                        <input type="text" name="psc" class="form-control" placeholder="Psč">
                    </div>

            </div>
            <div class="modal-footer">

                <div class="form-check pull-left">
                        <input class="form-check-input" name="send_notify_worker" type="checkbox" value="true" id="defaultCheck1">

                        <label style="font-size: 14px" class="form-check-label" for="defaultCheck1">
                          <strong>Poslať učiteľovi pozvnánku na prihlásenie?</strong>
                        </label>

                </div>


                <button class="btn btn-primary">Uložiť</button>
                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>--}}
            </div>
        </form>
        </div>


    </div>
</div>