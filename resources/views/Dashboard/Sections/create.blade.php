
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/sections.create')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('Sections.store') }}" method="post" autocomplete="off">
          @csrf
          <div class="modal-body">
              <label for="exampleInputPassword1">{{trans('Dashboard/sections.section_name')}}</label>
              <input type="text" name="name" class="form-control" required>
          </div>
          <div class="modal-body">
            <label for="exampleInputPassword1">{{trans('Dashboard/sections.description')}}</label>
            <textarea type="text" name="description" class="form-control"></textarea>
        </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections.close')}}</button>
              <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections.submit')}}</button>
          </div>
      </form>
        
      </div>
    </div>
  </div>