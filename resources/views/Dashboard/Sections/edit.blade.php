<!-- Modal -->
<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/sections.edit_sections')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Sections.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">{{trans('Dashboard/sections.section_name')}}</label>
                    <input type="hidden" name="id" value="{{ $section->id }}">
                    <input type="text" name="name" value="{{ $section->name }}" class="form-control" autocomplete="off" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
