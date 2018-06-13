<div class="list-group">
    @forelse( $users as $user)
        <a href="{{ route('messenger.show', [ $user->id, $user->slug ])  }}" class="list-group-item list-group-item-action
            {{ request()->is('*/' . $user->slug) ? 'active' : '' }}
            ">
            @if($user->haveNewMessage()) <strong class="text-danger">{{ $user->full_name() }}</strong> @else
            <strong>{{ $user->full_name() }}</strong>
            @endif

            @forelse($user->roles as $role)
                <span class="pull-right">{{ $role->name }}</span>
            @empty
                <span class="pull-right">Rola nepridelená</span>
            @endforelse
        </a>
    @empty
        Zatiaľ ste sami
    @endforelse
    <a href="{{ route('messenger.show', [ 1, 'programator' ])  }}" class="list-group-item list-group-item-action
            {{ request()->is('*/programator') ? 'active' : '' }}
            ">Tech. podpora</a>
</div>

{{--Panel pre superAdmina--}}
@if(auth()->user()->isSuperAdmin())

    <h3 class="mt-4">Administratori</h3>
    <div class="list-group">
        @forelse( $alladmins as $user)
            <a href="{{ route('messenger.show', [ $user->id, $user->slug ])  }}" class="list-group-item list-group-item-action
                {{ request()->is('*/' . $user->slug) ? 'active' : '' }}
                    ">
                @if($user->haveNewMessage()) <strong class="text-danger">{{ $user->full_name() }}</strong> @else
                    <strong>{{ $user->full_name() }}</strong>
                @endif

                @forelse($user->roles as $role)
                    <span class="pull-right">{{ $role->name }}</span>
                @empty
                    <span class="pull-right">Rola nepridelená</span>
                @endforelse
            </a>
        @empty
            Zatiaľ ste sami
        @endforelse
    </div>

@endif