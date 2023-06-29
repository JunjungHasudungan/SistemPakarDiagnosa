<div class="flex form-group">
	<ul class="font-extrabold text-yellow-900 ">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
