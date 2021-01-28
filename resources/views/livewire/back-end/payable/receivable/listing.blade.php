<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">To Receive<small> (Orders via Cash On Pickup)</small></h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">  

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <th class="table-sort" wire:click="sort('partners.name')">
                                Partner
                                @include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.name'])
                            </th>
                            <th>Sayang Commission</th>
                            <th>Total Amount</th>
                            <th>Total Orders</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $overall_total_commission = 0;
                            $overall_total_amount     = 0;
                            $overall_total_orders     = 0;
                        @endphp
                        @forelse($data as $row)
                            @php 
                                $order                     = $component->orders($row->partner_id);
                                $overall_total_commission += $order['total_sayang_commission'];
                                $overall_total_amount     += $order['total_amount'];
                                $overall_total_orders     += $order['total_order'];
                            @endphp
                            <tr>
                                <td>
                                    <a class="text-blue" href="javascript:void(0);">{{ucfirst($row->name)}}</a>
                                </td>
                                <td>PHP {{number_format($order['total_sayang_commission'],2)}}</td>
                                <td>PHP {{number_format($order['total_amount'],2)}}</td>
                                <td>{{number_format($order['total_order'])}}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" onclick="partner_receivable('{{$row->partner_key_token}}')" href="javascript:void(0);">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No Result Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">TOTAL</th>
                            <th>PHP {{number_format($overall_total_commission,2)}}</th>
                            <th>PHP {{number_format($overall_total_amount,2)}}</th>
                            <th>{{number_format($overall_total_orders)}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    function partner_receivable(key_token){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Getting Information...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('partner_receivable', key_token)
            }
        });
    }
</script>
@endpush
