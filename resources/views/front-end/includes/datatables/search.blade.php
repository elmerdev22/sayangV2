<div class="row">
	<div class="col-sm-7 col-md-8 col-lg-9 text-center text-sm-left">
		<div class="my-2">
			Show 
				<select class="border rounded" wire:model="show_entries">
					@foreach(Utility::datatables_show_entries() as $value)
						<option value="{{$value}}">{{$value}}</option>
					@endforeach
				</select> 
			Entries	
		</div>
	</div>
	<div class="col-sm-5 col-md-4 col-lg-3 text-center text-sm-right">
		<input type="search" wire:model.debounce.300ms="search" class="form-control" placeholder="Search...">
	</div>
</div>