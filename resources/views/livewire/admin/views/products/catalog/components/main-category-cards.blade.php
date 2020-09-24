<div class="row">
    @foreach($main_categories as $data)
        <div class="col-md-4">
            <div class="card card-outline-side collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">{{$data->name}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    The body of the card
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    @endforeach 
</div>


