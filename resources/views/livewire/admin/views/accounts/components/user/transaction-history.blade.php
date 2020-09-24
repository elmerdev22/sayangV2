<div>
    <div class="row small">
        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-3">
                    <div class="form-group row">
                        <label for="entries" class="col-sm-3 col-form-label text-lg-right">Show</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="entries" wire:model='paginate' wire:keypress='user'>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <label for="entries" class="col-sm-4 col-form-label text-left">Entries:</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-3 offset-sm-3 offset-md-3 offset-6">
                    <div class="form-group row">
                        <label for="search" class="col-sm-4 col-form-label text-right">Search:</label>
                        <div class="col-sm-8">
                            <input type="text" id="search" class="form-control" wire:model='search' wire:keypress='user'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-custom">
                    <thead>
                        <tr>
                            <th>{{__('Header 1')}}</th>
                            <th>{{__('Header 2')}}</th>
                            <th>{{__('Header 3')}}</th>
                            <th>{{__('Header 4')}}</th>
                            <th>{{__('Header 5')}}</th>
                            <th class='text-center'>{{__('Header 6')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transaction->total() === 0)
                            <tr>
                                <td colspan='6' class="text-center">{{__('No Results Found.')}}</td>
                            </tr>
                        @else
                            @foreach($transaction as $data)
                                <tr>
                                    <td>data 1</td>
                                    <td>data 2</td>
                                    <td>data 3</td>
                                    <td>data 4</td>
                                    <td>data 5</td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-sm" type="button" href="#">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1 offset-md-11">
            {{ $transaction->links() }}
        </div>
    </div>
</div>
