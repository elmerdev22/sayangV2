<div>
    <div class="row">
        <div class="col-md-3 offset-md-9 mb-2">
            <div class="row">
                <div class="col-4">
                    <select class="form-control" wire:model='paginate' wire:keypress='transaction'>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" wire:model='search' wire:keypress='transaction'>
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
                                        <a class="btn btn-outline-secondary rounded-circle" type="submit">
                                            <i class="fas fa-eye"></i>
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
