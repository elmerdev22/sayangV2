<div class="row">
	<div class="col-sm-6 col-md-4 col-lg-3 text-center text-sm-left">
		Showing {{$data->firstItem()}} to {{$data->lastItem()}} out of {{$data->total()}} items
	</div>
	<div class="col-sm-6 col-md-8 col-lg-9 text-center text-sm-right">
		{{$data->links()}}
	</div>
</div>