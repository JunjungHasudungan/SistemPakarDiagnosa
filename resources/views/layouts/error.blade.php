<div class="flex form-group">
	<ul>
		@foreach($errors->all() as $error)
            <span class="text-red-500 text-sm">
                {{ $error }}
            </span>
		@endforeach
	</ul>
</div>
