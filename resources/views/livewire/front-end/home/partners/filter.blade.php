<div>
    <div class="card">
        <!-- Location filter -->
        @livewire('front-end.product.listing.location-filter', ['collapse' => 'show'])
        <!-- Location filter \end. -->
        <article class="filter-group">
            <div class="filter-content">
                <div class="card-body">
                    <button type="button" wire:loading.attr="disabled" wire:target="clear_filter" wire:click="clear_filter" class="btn btn-block btn-primary" id="clear-filter">
                        Clear Filter <span wire:loading wire:target="clear_filter" class="fas fa-spin fa-spinner"></span>
                    </button>
                </div>
            </div>
        </article> <!-- filter-group .// -->
    </div> <!-- card.// -->
</div>
