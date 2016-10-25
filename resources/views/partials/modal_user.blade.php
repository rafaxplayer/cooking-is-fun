<!-- Modal -->
<div class="modal fade" id="modaluser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Opciones de usuario</h4>
      </div>
      <div class="modal-body">
        <div class="list-group">
          <a href="{{url('auth/logout')}}" class="list-group-item">Salir</a>
          <a href="{{url('user/panel')}}" class="list-group-item">Panel de control</a>
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>