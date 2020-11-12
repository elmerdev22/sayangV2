<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Bids Settings</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-3">
                <label>Minimum Bids (in percent %)</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          %
                        </span>
                    </div>
                    <input type="number" class="form-control text-center" min="1" max="100" wire:model.lazy="bid_increment_percent">
                    <div class="input-group-append bg-warning">
                      <button class="btn btn-warning" wire:click="update_bid_increment_percent">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>