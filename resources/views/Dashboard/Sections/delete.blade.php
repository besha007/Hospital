<!-- Modal -->
<div class="modal fade" id="delete{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/sections.delete_sections')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('Sections.destroy', 'test') }}" method="POST">
              {{ method_field('delete') }}
              {{ csrf_field() }}
          <div class="modal-body">
              <input type="hidden" name="id" value="{{ $section->id }}">
              <h5 class="text text-danger">{{ trans('Dashboard/sections.delete_??') }}</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections.close')}}</button>
              <button type="submit" class="btn btn-danger">{{trans('Dashboard/sections.delete')}}</button>
          </div>
          </form>
      </div>
  </div>
</div>
