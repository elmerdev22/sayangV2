<div>
    <div class="row">
        @for($x=1;$x <= 6;$x++)
            <div class="col-md-4">
                <div class="card card-warning card-outline collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Collapsible Card Example</h3>
                        <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-chevron-down"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <p>
                            <a class="text-secondary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Toggle first element</a>
                        </p>
                        <div class="collapse multi-collapse text-secondary" id="multiCollapseExample1">
                            <p>
                                <a class="text-secondary" data-toggle="collapse" href="#test1" role="button" aria-expanded="false" aria-controls="test1">Toggle first element</a>
                            </p>
                            <div class="collapse multi-collapse text-secondary" id="test1">
                                The body of the card
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        @endfor
    </div>
</div>
