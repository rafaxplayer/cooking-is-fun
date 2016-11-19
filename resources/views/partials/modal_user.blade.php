<!-- Modal -->
<div class="modal fade" id="modaluser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans('textsapp.modal.options')}}</h4>
      </div>
      <div class="modal-body">
        <div class="list-group">
          <a href="{{url('auth/logout')}}" class="list-group-item">{{trans('textsapp.modal.options.exit')}}</a>
          <a href="{{url('user/panel/perfil')}}" class="list-group-item">{{trans('textsapp.modal.options.panel')}}</a>
          @if(Auth::check())
            @if(Auth::user()->isAdmin())
               <a href="{{url('admin')}}" class="list-group-item">{{trans('textsapp.modal.options.paneladmin')}}</a>
            @endif
          @endif
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('textsapp.modal.options.button')}}</button>
        
      </div>
    </div>
  </div>
</div>