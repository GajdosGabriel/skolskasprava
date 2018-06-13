<!-- Modal -->
<div class="modal fade" id="{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('students.add.parent', [$user->id]) }}" method="POST" class="form">
            @csrf {{ csrf_field('PUT') }}

            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Priradiť rodiča k
                <strong>{{ $user->full_name() }}</strong>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text text-danger">Rodič</div>
                    </div>

                    <select name="parent_id" class="form-control" required id="exampleFormControlSelect1">
                        <option value="" selected disabled hidden>--Vybrať rodiča--</option>
                        @forelse( $parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->full_name_reverse() }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Uložiť</button>
            </div>
        </form>
        </div>
    </div>
</div>