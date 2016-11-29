<!-- Modal -->
<div class="modal fade" id="modalcategories" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Categorias para la receta</h4>
      </div>
      <div class="modal-body">
        @foreach(App\Models\Category::all() as $cat)
        <div class="input-group">
          <span class="input-group-addon">
            <input type="checkbox" name="categories[{{$cat->id}}]" value="{{$cat->id}}" aria-label="..."{{isset($recipe) && $cats->contains($cat)?'checked':''}}>
          </span>
          <input value=" {{$cat->name}}"/>
        </div>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>