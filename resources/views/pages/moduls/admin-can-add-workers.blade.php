
@if(auth()->user()->countOfWorkers() < 1)
<div class="alert alert-info" role="alert">
    <strong>Ste administrátor, môžete pridať nových zamestnancov. <a href="{{ route('workers.index') }}">Pridať</a></strong>
</div>
@endif
