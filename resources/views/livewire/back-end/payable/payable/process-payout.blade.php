<div>
    @if($data)
        <form method="POST" wire:submit.prevent="update">
            <hr>
            <div class="form-group">
                <b>ORDER DATE: </b> {{date('M/d/Y', strtotime($date_from))}} - {{date('M/d/Y', strtotime($date_to))}}
            </div>
            <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                <thead>
                    <tr>
                        <th>Partner</th>
                        <th>Sayang Commission</th>
                        <th>Online Payment Fee</th>
                        <th>Net Amount</th>
                        <th>Total Amount</th>
                        <th>Total Orders</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    @for($x=1;$x<=10;$x++)
                        <tr>
                            <td>
                                <a class="text-blue" target="_blank" href="javascript:void(0);">{{rand(10000,999999)}}</a>
                            </td>
                            <td>PHP {{number_format(rand(100,10000),2)}}</td>
                            <td>PHP {{number_format(rand(100,10000),2)}}</td>
                            <td>PHP {{number_format(rand(100,10000),2)}}</td>
                            <td>PHP {{number_format(rand(100,10000),2)}}</td>                            
                            <td>{{number_format(rand(1,100))}}</td>
                            <td>
                                <div class="icheck-warning">
                                    <input type="checkbox" id="select-{{$x}}" checked="true">
                                    <label for="select-{{$x}}"></label>
                                </div>
                            </td>                            
                        </tr>
                    @endfor
                </tbody>
            </table>

            <div class="text-right mt-3">
                <div class="form-group">
                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Cancel</button>
                    <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-check"></i> Submit</button>
                </div>
            </div>
        </form>
    @endif
</div>
