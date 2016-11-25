<div class="row">
@foreach($recipes as $recipe)
	<div class="col-md-3 col-sm-4 col-xs-12">
		<div class="item_recipe">
			<figure>
				<img src="{{$recipe->img_url}}"  alt="imagen de la receta">
			</figure>
			<div class="info">
				<h3>{{$recipe->name}}</h3>
				<p><i class="fa fa-clock-o" aria-hidden="true"></i> {{$recipe->elaboration_time}}</p>
				<p><i class="fa fa-user-circle" aria-hidden="true"></i> {{$recipe->user->name}}</p>
				@if(count($recipe->categories) > 0)
					<p><i class="fa fa-tag" aria-hidden="true"></i> {{$recipe->categoriesToString()}}</p>
				@endif
			</div>
		</div>
	</div>
@endforeach
</div>
{!!$recipes->render()!!}