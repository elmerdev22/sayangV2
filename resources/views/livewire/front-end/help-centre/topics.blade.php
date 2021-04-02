<div>
    @if (!$is_select)
        <div class="row">
            @forelse ($data as $item)
                <div class="col-md-3 mb-3">
                    <div class="card card-body" style="cursor: pointer;" onclick="select_topic('{{$item->id}}')">
                        <figure class="text-center">
                            <div class="img-wrap"> <img class="img-sm rounded-circle" src="{{UploadUtility::help_centre_photos($item->id)}}"> </div>
                            <figcaption class="pt-4">
                                <h5 class="title">{{ucwords($item->topic)}}</h5>
                            </figcaption>
                        </figure> <!-- iconbox // -->
                    </div> <!-- panel-lg.// -->
                </div><!-- col // -->
            @empty
                <div class="col-12 text-center">
                    <img class="img-thumbnail border-0" src="{{Utility::img_source('not_found')}}">
                </div> 
            @endforelse
        </div>
    @else 
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-light float-right" onclick="back()"><i class="fas fa-arrow-alt-circle-left"></i>
                    Go Back
                </button>
            </div>
            <div class="col-12">
                <div class="accordion" id="accordionTopics">
                    @foreach ($data as $row)
                        <div class="card">
                            <div class="card-header cursor-pointer" id="Heading-{{$row->id}}" data-toggle="collapse" data-target="#Topic-{{$row->id}}" aria-expanded="true" aria-controls="Topic-{{$row->id}}">
                                
                                <h2 class="mb-0">
                                    <img class="icon icon-sm rounded-circle" src="{{UploadUtility::help_centre_photos($row->id)}}">
                                    <button class="btn btn-default" type="button">
                                        {{ucwords($row->topic)}}
                                    </button>
                                </h2>
                            </div>
                            <div id="Topic-{{$row->id}}" class="collapse {{$selected_topic_id == $row->id ? 'show': ''}}" aria-labelledby="Heading-{{$row->id}}" data-parent="#accordionTopics">
                                <div class="card-body">
                                    <div class="accordion" id="accordionQuestion">
                                        @forelse ($row->help_centre_question as $question)
                                            <div class="card border-0">
                                                <div class="card-header border-bottom-0 cursor-pointer" id="HeadingQuestion-{{$question->id}}" data-toggle="collapse" data-target="#Question-{{$question->id}}" aria-expanded="true" aria-controls="Question-{{$question->id}}">
                                                    <div class="pt-1 ml-2">
                                                        <a href="javascript:void(0);">{{ucwords($question->question)}}</a>
                                                    </div>
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
                                                <li>No Questions added.</li>
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