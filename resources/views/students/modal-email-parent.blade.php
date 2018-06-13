<!-- Modal -->
<div class="modal fade" id="email{{ $parent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('students.add.parent', [$user->parent_id]) }}" method="POST" class="form">
            @csrf {{ csrf_field('PUT') }}

            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pridať email rodičovi
                <strong>{{ $parent->full_name() }}</strong>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text {{ $errors->has('email') ? ' has-error' : '' }}">Email</div>
                    </div>
                    <input type="email" name="email"  class="form-control" required>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Vložiť</button>
                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>--}}
            </div>
        </form>
        </div>
    </div>
</div>