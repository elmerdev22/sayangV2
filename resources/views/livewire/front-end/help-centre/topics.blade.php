<div>
    @if (!$is_select)
        <div class="row">
            @forelse ($data as $item)
                <div class="col-lg-3 col-md-4 col-sm-6  col-6 text-center">
                    <div class="card topic-card text-center" onclick="select_topic('{{$item->id}}')">
                        <img class="card-img-top p-3 text-center img-responsive" style="margin:0 auto; height: 150px; width: auto;" src="{{UploadUtility::help_centre_photos($item->id)}}" alt="Card image cap">
                        <div class="card-footer bg-white ">
                            <p class="card-text topic-name">{{ucwords($item->topic)}}</p>
                        </div>
                    </div>
                </div>
            @empty
            <div class="col-12 text-center">
                <img class="img-thumbnail border-0" src="{{Utility::img_source('not_found')}}">
            </div> 
            @endforelse
        </div>
    @else 
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-danger float-right" onclick="back()"><i class="fas fa-arrow-alt-circle-left"></i>
                    Go Back
                </button>
            </div>
            <div class="col-12">
                <div class="accordion" id="accordionTopics">
                    @foreach ($data as $row)
                        <div class="card">
                            <div class="card-header bg-light cursor-pointer p-3" id="Heading-{{$row->id}}" data-toggle="collapse" data-target="#Topic-{{$row->id}}" aria-expanded="true" aria-controls="Topic-{{$row->id}}">
                                <img class="img-sm img-rounded img-responsive shadow-sm" src="{{UploadUtility::help_centre_photos($row->id)}}">
                                <h4 class="card-title pt-1 ml-2">
                                    <a href="javascript:void(0);">{{ucwords($row->topic)}}</a>
                                </h4>
                            </div>
                            <div id="Topic-{{$row->id}}" class="collapse {{$selected_topic_id == $row->id ? 'show': ''}}" aria-labelledby="Heading-{{$row->id}}" data-parent="#accordionTopics">
                                <div class="card-body">
                                    <div class="accordion" id="accordionQuestion">
                                        @forelse ($row->help_centre_question as $question)
                                            <div class="card shadow-none m-0">
                                                <div class="card-header border-bottom-0 cursor-pointer" id="HeadingQuestion-{{$question->id}}" data-toggle="collapse" data-target="#Question-{{$question->id}}" aria-expanded="true" aria-controls="Question-{{$question->id}}">
                                                    <h4 class="card-title pt-1 ml-2">
                                                        <a href="javascript:void(0);">{{ucwords($question->question)}}</a>
                                                    </h4>
                                                </div>
                                        
                                                <div id="Question-{{$question->id}}" class="collapse " aria-labelledby="HeadingQuestion-{{$question->id}}" data-parent="#accordionQuestion">
                                                    <div class="card-body py-0">
                                                        @forelse ($question->help_centre_answer as $answer)
                                                            <ul>
                                                                <li>{{$answer->answer}}</li>
                                                            </ul>
                                                        @empty
                                                        <ul>
                                                            <li>No Answer added.</li>
                                                        </ul>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <ul>
                                                <li>No Answer added.</li>
                                            </ul>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@push('scripts')
<script>
    function back(){
        location.reload();
    }
    function select_topic(id){
        $.LoadingOverlay("show");
        @this.call('select_topic', id)
    }
    window.livewire.hook('afterDomUpdate', () => {
        $.LoadingOverlay("hide");
    });
</script>   
@endpush