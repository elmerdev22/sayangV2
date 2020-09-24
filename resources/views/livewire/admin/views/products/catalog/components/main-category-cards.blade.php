<div class="row">
    @foreach($main_categories as $data)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" data-toggle="collapse" href="#{{$data->name}}" role="button" aria-expanded="false" aria-controls="{{$data->name}}">
                        <h6 class="font-weight-bold ">{{$data->name}}<i class="fa fa-chevron-down float-right pt-1"></i></h6> 
                </div>
                <div class="collapse" id="{{$data->name}}">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    @endforeach 
</div>
