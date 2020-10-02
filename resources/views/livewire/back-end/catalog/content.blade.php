<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang">
                <div class="card-header">
                    <input type="search" wire:model="search" class="form-control" placeholder="Search Category Name...">
                <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @forelse($data as $category)
                        <div class="col-12">
                            <div class="card card-outline card-sayang collapsed-card" wire:ignore.self>
                                <div class="card-header">
                                    <h3 class="card-title">{{ucwords($category->name)}}</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form wire:submit.prevent="add({{$category->id}})">
                                                <label>Add Tags</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy="name" placeholder="Tag Name">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-warning">
                                                            <span class="fas fa-plus"></span>
                                                        </button>
                                                    </div>

                                                    @error('name') 
                                                        <span class="invalid-feedback" style="display: block;">
                                                            <span>{{$message}}</span>
                                                        </span> 
                                                    @enderror
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        @forelse($category->tags as $tag)
                                            <div class="col-lg-4 col-md-6">
                                                <span class="fas fa-chevron-right"></span> 
                                                {{ucwords($tag->name)}}
                                            </div>
                                        @empty
                                            <div class="col-lg-4 col-md-6">
                                                <span class="fas fa-chevron-right"></span> 
                                                No Tags!
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <h5 class=" bg-warning py-2 text-center">No Found Data!</h5>
                        </div>
                        @endforelse
                    </div>
                    <div class="row justify-content-right">
                        <div class="col-12">
                            {{$data->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
