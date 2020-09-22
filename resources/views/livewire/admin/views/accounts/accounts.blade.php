<div>
    <div class="card card-warning card-outline">
        <div class="card-body">
           <div class="row">
                <div class="col-md-3 offset-md-9 mb-2">
                    <div class="row">
                        <div class="col-4">
                            <select class="form-control" wire:model='paginate' wire:keypress='user'>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" wire:model='search' wire:keypress='user'>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-custom">
                            <thead>
                                <tr>
                                    <th>{{__('First Name')}}</th>
                                    <th>{{__('Last Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Date Joined')}}</th>
                                    <th class='text-center'>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($user->total() === 0)
                                    <tr>
                                        <td colspan='6' class="text-center">{{__('No Results Found.')}}</td>
                                    </tr>
                                @else
                                    @foreach($user as $data)
                                        <tr>
                                            <td>{{$data->first_name}}</td>
                                            <td>{{$data->last_name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td><span class='badge @if($data->verified_at) badge-success @else badge-danger @endif'>{{isset($data->verified_at) ? __('Verified At').' '.date('m-d-Y',strtotime($data->verified_at)) : __('Not Yet Verified')}}</span></td>
                                            <td>{{date('m-d-Y',strtotime($data->created_at))}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-outline-secondary rounded-circle" type="button" href="{{route('admin.cms.'.$type.'.profile', ['key_token' => $data->key_token,'type' => $type])}}">
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
                    {{ $user->links() }}
                </div>
           </div>
        </div>
    </div>
</div>
