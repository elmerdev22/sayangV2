@extends('front-end.layout')
@section('title','Help Centre')
@section('content')

<section class="content bg-dark">
    <div class="container">
        @livewire('front-end.help-centre.search')
    </div> 
</section>
<section class="content-header my-2">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Topics</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front-end.help-centre.index')}}">Help Centre</a></li>
                    <li class="breadcrumb-item active">Results</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
		<div class="row">
			@if($results->count() > 0)
				<div class="col-12 mb-2">
					<h5><a>Results for "{{$question}}" in All Topics</a></h5>
				</div>
			@endif
			@php $collection_data = []; @endphp
			<div class="mb-5">
				@forelse($results as $result)
					<div class="col-12">
						@if (!in_array($result->topic, $collection_data)) 
							<h5 class="pl-1 pr-1 pt-2 pb-2 ">{{ucfirst($result->topic)}}</h5>
                        @endif
                        @if ($result->question)
                        
                            @if (!in_array($result->question, $collection_data)) 
                                <h6 class="pl-3 pr-3 pt-2 pb-2 ">
                                    <span class="fa fa-chevron-right">
                                    </span> 
                                    {{ucfirst($result->question)}}
                                </h6>
                            @endif
                            
                            <p class="pl-4 pr-4 pt-2 pb-2 "> 
                                
                                @if ($result->answer)
                                    • {!! ucfirst(str_replace($question ,"<mark>".$question."</mark>", $result->answer)) !!}
                                @else
                                    @if (!in_array($result->question, $collection_data)) 
                                        • No Answer added.
                                    @endif
                                @endif
                            </p>
                        @else 
                            • No Questions added.
                        @endif

						@php array_push($collection_data, $result->topic, $result->question); @endphp
					</div>
					
				@empty
			</div>
			<div class="col-12" style="height: 200px;">
				<h5><a>No results for "{{$question}}" in All Topic</a></h5>
				<br>
				<h5>Try searching another keyword. <a href="{{url('/help-centre')}}" class="btn-link">Browse Help Center</a></h5>
			</div>
			@endforelse
		</div>
    </div> 
</section>
@endsection
