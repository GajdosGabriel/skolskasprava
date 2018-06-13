


            <div class="card border border-primary">
            <div class="card-header bg-primary text-white">Vaše údaje:</div>
                <div class="card-body">
                    <strong>{{ $user->company }}</strong><br>
                    {{ $user->street }}<br>
                    {{ $user->city }}, Psč {{ $user->psc }}<br>
                    ICO: {{ $user->ico }}
                    <a href="{{ route('user.edit', [ auth()->user()->id, auth()->user()->slug ]) }}" class="pull-right btn btn-xs btn-info">Upraviť profil</a>
                </div>
            </div>





