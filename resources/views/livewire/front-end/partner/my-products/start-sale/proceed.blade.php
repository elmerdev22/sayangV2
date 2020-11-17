<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="modal-body">
            <div class="form-group">
                <label>Products : {{number_format(count($selected_products), 0)}} items</label>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            {{-- <th scope="col">Regular price</th> --}}
                            <th scope="col">Buy now price</th>
                            <th scope="col">Lowest price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                        </thead>
                    <tbody>
                        @foreach($selected_products as $product)
                            <tr>
                                <td>{{ucfirst($component->product($product['product_id'])->name)}}</td>
                                {{-- <td>{{number_format($product['regular_price'],2)}}</td> --}}
                                <td>{{number_format($product['buy_now_price'],2)}}</td>
                                <td>{{number_format($product['lowest_price'],2)}}</td>
                                <td>{{number_format($product['quantity'])}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- DateTime Picker -->
            <div class="bootstrap-timepicker" wire:ignore wire:key="start_date_datetimepicker">
                <div class="form-group">
                    <label>Start Date</label>
                    <div class="input-group date" id="start_date" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input input-readonly" data-target="#start_date" readonly="true">
                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bootstrap-timepicker" wire:ignore wire:key="end_date_datetimepicker">
                <div class="form-group">
                    <label>End Date</label>
                    <div class="input-group date" id="end_date" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input input-readonly" data-target="#end_date" readonly="true">
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            @error('start_date')
                <span class="invalid-feedback d-block">
                    <span>{{$message}}</span>
                </span>
            @enderror
            @error('end_date')
                <span class="invalid-feedback d-block">
                    <span>{{$message}}</span>
                </span>
            @enderror
            @if($hours_error != '')
                <span class="invalid-feedback d-block">
                    <span>{{$hours_error}}</span>
                </span>
            @endif
            @error('selected_products')
                <span class="invalid-feedback d-block">
                    <span>{{$message}}</span>
                </span>
            @enderror
        </div>
        <div class="modal-footer">
            <button wire:target="store" wire:loading.attr="disabled" type="submit" class="btn btn-primary">
                Start a Sale <span wire:loading wire:target="store" class="fas fa-spinner fa-spin"></span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $(document).on('change', '#start_date', function (){
            var start_date   = $(this).val();
            if(start_date != ''){
                $(document).find('#end_date').attr('min', start_date);
            }else{

            }
        });

        init_start_date();
        init_end_date();

        $("#start_date").on("change.datetimepicker", function (e){
            var minDate = moment(e.date).format("YYYY/MM/DD");
            init_end_date(minDate);
            @this.call('set_date', 'start_date', e.date['_d'])
        });
        $("#end_date").on("change.datetimepicker", function (e){              
            @this.call('set_date', 'end_date', e.date['_d'])
        });
    });
    
    function init_start_date(minDate=null){
        var datetime_config = date_config();
            if(minDate == null){
                datetime_config['minDate'] = '{{date("Y/m/d")}}';
            }else{
                datetime_config['minDate'] = minDate;
            }

        $('#start_date').datetimepicker("destroy");
        $('#start_date').datetimepicker(datetime_config);
    }

    function init_end_date(minDate=null){
        var datetime_config = date_config();
            if(minDate == null){
                datetime_config['minDate'] = '{{date("Y/m/d")}}';
            }else{
                datetime_config['minDate'] = minDate;
            }

        $('#end_date').datetimepicker("destroy");
        $('#end_date').datetimepicker(datetime_config);
    }

    function date_config(){
        return  {
            format        : 'MM/DD/YYYY @ hh:00A',
            ignoreReadonly: true,
            icons         : {
                time : "fas fa-clock",
                date : "fas fa-calendar",
                up   : "fas fa-arrow-up",
                down : "fas fa-arrow-down"
            }
        };
    }

    window.livewire.on('proceed_done', param => {
        setTimeout(function () {
            Swal.close();
            $('#modal-proceed_start_sale').modal('show');
        }, 1500);
    });
</script>
@endpush