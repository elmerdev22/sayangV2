<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title"> Advocacy Section </h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save_text_data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Header</label>
                            <textarea class="form-control" wire:model.lazy="header"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Subheader</label>
                            <textarea class="form-control" wire:model.lazy="sub_header"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Save <span wire:loading wire:target="save_text_data" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-12">
                    <label>Cards</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 py-3">
                    <div class="card bg-dark aos-init aos-animate" data-aos="zoom-in">
                        <img src="https://image.freepik.com/free-photo/farmer-hand-watering-young-baby-plants_35892-713.jpg" class="card-img opacity">
                        <div class="card-img-overlay text-white">
                            <h5 class="card-title">Trees</h5>
                            <p class="card-text">This is a wider card with a text below</p>
                            <a href="#" class="btn btn-light">Discover</a>
                        </div>
                    </div> 
                </div> <!-- col.// -->
                <div class="col-md-4 py-3">
                    <div class="card bg-dark aos-init aos-animate" data-aos="zoom-in">
                        <img src="https://image.freepik.com/free-photo/plant-growing-ground_1150-19317.jpg" class="card-img opacity">
                        <div class="card-img-overlay text-white">
                            <h5 class="card-title">Water</h5>
                            <p class="card-text">This is a wider card with text below</p>
                            <a href="#" class="btn btn-light">Discover</a>
                        </div>
                    </div>
                </div> <!-- col.// -->
                <div class="col-md-4 py-3">
                    <div class="card bg-dark aos-init aos-animate" data-aos="zoom-in">
                        <img src="https://image.freepik.com/free-photo/farmer-hand-watering-young-baby-plants_35892-713.jpg" class="card-img opacity">
                        <div class="card-img-overlay text-white">
                            <h5 class="card-title">Energy</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
                            <a href="#" class="btn btn-light">Discover</a>
                        </div>
                    </div>
                </div> <!-- col.// -->
            </div>
        </div>
    </div>
</div>