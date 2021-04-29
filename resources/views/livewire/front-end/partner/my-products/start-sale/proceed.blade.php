<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="modal-body">
                <div>Note: The Minimum is {{$min_hours}}hours and Maximum is {{$max_hours}}hours.</div>
            <hr>
            <!-- Date Range Picker -->
            <div class="form-group" wire:ignore wire:key="start_date_daterangepicker">
                <label for="start_date">Start Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" value="" class="form-control input-readonly" id="start_date" readonly="true" placeholder="MM/DD/YYYY @ hh:mm A">
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group" wire:ignore wire:key="end_date_daterangepicker">
                <label for="end_date">End Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" value="" class="form-control input-readonly" id="end_date" readonly="true" placeholder="MM/DD/YYYY @ hh:mm A">
                </div>
                <!-- /.input group -->
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
            
            <hr>

            <div class="form-group">
                <label>Products : {{number_format(count($selected_products), 0)}} items</label>
                <div class="table-responsive">
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
            </div>
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
        init_start_date();
        init_end_date();
    });

    function start_daterangepicker_init(picker){
        var type = 'start_date';
        var date = picker.startDate['_d'];
        @this.call('set_date', type, date)
        $('#'+type).val(moment(date).format('MM/DD/YYYY @ hh:mm A'));
        end_daterangepicker_init(picker, date);
        init_end_date(date);
    }

    function end_daterangepicker_init(picker, new_date=null){
        var type = 'end_date';

        if(new_date != null){
            var date        = new Date(new_date);
            var min_seconds = {{$min_hours}} * 3600;
                date.setSeconds(date.getSeconds() + min_seconds);
        }else{
            var date = new Date(picker.endDate['_d']);
        }

        $('#'+type).val(moment(date).format('MM/DD/YYYY @ hh:mm A'));
        @this.call('set_date', type, date)
    }

    function init_start_date(minDate=null){
        var datetime_config = date_config(1);
            if(minDate == null){
                datetime_config['minDate'] = new Date();
            }else{
                datetime_config['minDate'] = minDate;
            }

        // $('#start_date').daterangepicker("destroy"); 
        $('#start_date').daterangepicker(datetime_config);
        $('#start_date').on('apply.daterangepicker', function(ev, picker) {
            start_daterangepicker_init(picker);
        });
    }

    function init_end_date(minDate=null){
        var datetime_config = date_config(15);
        var min_seconds     = {{$min_hours}} * 3600;
        var max_seconds     = {{$max_hours}} * 3600;

        if(minDate == null){
            minDate = new Date();
        }else{
            minDate = new Date(minDate);
            minDate.setSeconds(minDate.getSeconds() + min_seconds);
        }
        datetime_config['minDate'] = minDate;
        
        var maxDate = new Date();
            maxDate.setSeconds(maxDate.getSeconds() + max_seconds);
        datetime_config['maxDate'] = maxDate;

        // $('#end_date').daterangepicker("destroy");
        $('#end_date').daterangepicker(datetime_config);
        $('#end_date').on('apply.daterangepicker', function (ev, picker){    
            end_daterangepicker_init(picker, null);
        });
    }

    function date_config(timePickerIncrement){
        return {
            container          : '#modal-proceed_start_sale',
            opens              : 'left',
            ignoreReadonly     : true,
            singleDatePicker   : true,
            timePicker         : true,
            autoUpdateInput    : false,
            timePickerIncrement: timePickerIncrement,
            locale             : {
                format: 'MM/DD/YYYY @ hh:mm A'
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