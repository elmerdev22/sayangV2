<div>
    <div class="row justify-content-center ">
        <div class="col-md-7 text-center">
            <h2 class="title-page text-white">We’re Here to Help!</h2>
            <form method="GET" action="{{route('front-end.help-centre.ask')}}" id="ask-form">
                <div class="input-group input-group-lg">
                    <input class="form-control form-control-navbar border-none shadow-none" type="search" placeholder="Ask away" aria-label="Search" autocomplete="off" name="question" wire:model="search" required>
                    <div class="input-group-append">
                        <button class="btn btn-light" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="position-absolute mt-5 shadow w-100" style="z-index: 2;">
                        @if($search)
                            <div style="max-height: 300px; overflow: auto; ">
                                <ul class="list-group text-black-50 text-left">
                                    @foreach ($data as $row)
                                        <a wire:click="select_question('{{$row->id}}')" href="javascript:void(0);" class="list-group-item list-group-item-action">{{$row->question}}</a>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.livewire.on('submit_form', param => {
        $('#ask-form').submit();
    });
</script>   
@endpush