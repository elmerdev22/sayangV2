<div>
    <div class="row">
	    <div class="col-md-12">
	        <div class="card card-outline card-sayang">
	            <div class="card-header">
                    <h3 class="card-title">Questions </h3>
                    <button class="btn btn-xs btn-warning float-right" onclick="question_modal('add')"><span class="fas fa-plus"></span>  Add Question</button>
                </div>
                <div class="card-body">
                        @forelse ($data as $question)
                            <div class="card">
                                <div class="card-header border-bottom-0 cursor-pointer" >
                                    <h4 class="card-title pt-1 ml-2">
                                        <p class="card-text">{{ucwords($question->question)}}</p>       
                                    </h4>
                                    <div class="card-tools">
                                        
                                        <button class="btn btn-xs btn-default" id="question-{{$question->id}}" data-question="{{$question->question}}" onclick="question_modal('edit', '{{$question->id}}')"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-xs btn-danger" onclick="delete_question('{{$question->id}}')"><span class="fas fa-trash"></span></button> 
                                    </div>
                                </div>
                        
                                <div class="card-body py-0">
                                    <button class="btn btn-warning btn-xs float m-2" onclick="add_answer('{{$question->id}}')"><span class="fas fa-plus"></span> Add Answer</button>
                                    @forelse ($question->help_centre_answer as $answer)
                                        <ul>
                                            <li>
                                                {{$answer->answer}}            
                                                {{-- <button class="btn btn-xs btn-default"><span class="fas fa-edit"></span></button> --}}
                                                <button class="btn btn-xs btn-danger" onclick="delete_answer('{{$answer->id}}')"><span class="fas fa-trash"></span></button>
                                            </li>
                                        </ul>
                                    @empty
                                    <ul>
                                        <li>No Answer added.</li>
                                    </ul>
                                    @endforelse
                                </div>
                            </div>
                        @empty
                            <ul>
                                <li>No Question added.</li>
                            </ul>
                        @endforelse
                    {{-- @forelse ($data as $row)
                        <div class="row mb-2">
                            <div class="col-12">
                                <span class="fas fa-chevron-circle-right"></span> 
                                {{ucfirst($row->question)}} 
                                <button class="btn btn-xs btn-default" id="question-{{$row->id}}" data-question="{{$row->question}}" onclick="question_modal('edit', '{{$row->id}}')"><span class="fas fa-edit"></span></button>
                                <button class="btn btn-xs btn-danger" onclick="delete_question('{{$row->id}}')"><span class="fas fa-trash"></span></button>
                            </div>
                            <div class="col-12 px-4">
                                <button class="btn btn-warning btn-xs my-2" onclick="add_answer('{{$row->id}}')"><span class="fas fa-plus"></span> Add Answer</button>
                                @forelse ($row->help_centre_answer as $item)
                                    <p class="text-justify">
                                        <span class="fas fa-chevron-right"></span> 
                                        {{ucfirst($item->answer)}}  
                                        <button class="btn btn-xs btn-default"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-xs btn-danger" onclick="delete_answer('{{$item->id}}')"><span class="fas fa-trash"></span></button>
                                    </p>
                                @empty
                                    <p>
                                        <span class="fas fa-chevron-right"></span> No Answer Yet.
                                    </p>
                                @endforelse
                            </div>
                        </div>
                        <hr>
                    @empty
                        <div class="text-center">No Questions Added.</div>
                    @endforelse --}}
                </div>
	        </div>
	    </div>
    </div>
    
    <!--Add Question Modal -->
    <div wire:ignore.self class="modal fade" id="save-question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" wire:submit.prevent="save_question">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{$selected_question_id ? 'Edit' : 'Add'}} Question
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Question</label>
                            <textarea class="form-control" placeholder="Question here..." wire:model.lazy="question"></textarea>
							@error('question')
				                <span class="invalid-feedback" style="display: block;">
				                    <span>{{$message}}</span>
				                </span> 
				            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="save_question" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Add Answer Modal -->
    <div wire:ignore.self class="modal fade" id="add-answer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" wire:submit.prevent="add_answer">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Answer
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Answer</label>
                            <textarea class="form-control" placeholder="Answer here..." wire:model.lazy="answer"></textarea>
							@error('answer')
				                <span class="invalid-feedback" style="display: block;">
				                    <span>{{$message}}</span>
				                </span> 
				            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="add_answer" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    
    function delete_question(id){
        Swal.fire({
            title: 'Are you sure you want to Delete?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Confirm`,
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete_question', id)
            } 
        })
    }

    function delete_answer(id){
        Swal.fire({
            title: 'Are you sure you want to Delete?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Confirm`,
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete_answer', id)
            } 
        })
    }

    function question_modal(type, id = null){
        if(type == 'edit'){
            @this.set('selected_question_id', id)
            @this.set('question', $('#question-'+id).data('question'))
        }
        $('#save-question').modal('show');

    }

    function add_answer(id){
        $('#add-answer').modal('show');
        @this.set('selected_question_id', id);
    }
    
    window.livewire.on('close_modal', param => {
        $('#save-question').modal('hide');
    });
</script>    
@endpush