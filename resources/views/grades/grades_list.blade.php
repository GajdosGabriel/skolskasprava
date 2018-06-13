
<div class="col-md-12 mb-2">
    <div class="row">
            <h5>Triedy:
            @forelse($grades as $grade)
                    <a href="{{ route('grades.show', [$grade->id]) }}"><strong
                        class="badge
                        {{ request()->is('*/' . $grade->id) ? 'badge-primary' : 'badge-secondary' }}
                        ">
                            {{ $grade->name }} </strong>
                    </a>
                @empty
                    <p>Triedy nie sú založené</p>
                @endforelse
            </h5>
            </div>
</div>
