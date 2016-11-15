<!-- Modal -->
<div class="modal fade" id="modalconfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans('textsapp.modal.deleterecipe')}}</h4>
      </div>
      <div class="modal-body">
        <p id="message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        {!!Form::open(['route' =>array('recipes.destroy',$recipe->id), 'method' => 'delete','style'=>'display:inline-block'])!!}
        <button href="" type="submit" class="btn btn-danger">Si</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>