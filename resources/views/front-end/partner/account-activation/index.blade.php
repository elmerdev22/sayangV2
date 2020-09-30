@extends('front-end.layout')
@section('title','Account Activation')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Account Activation',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Account Activation'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<div class="row justify-content-center">
    <main class="col-md-9">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title"> Account Activation</h5> 
            </div>
            <div class="card-body">
                <div id="stepper1" class="bs-stepper linear">

                    <!-- STEPPER TAB -->
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step active" data-target="#test-l-1">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1" aria-selected="true">
                            <span class="bs-stepper-circle">1</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#test-l-2">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">2</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#test-l-3">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">3</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#test-l-4">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">4</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#test-l-5">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger5" aria-controls="test-l-5" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">5</span>
                            </button>
                        </div>
                    </div>
                    <!-- /. END OF STEPPER TAB -->

                    <!-- STEPPER CONTENT -->
                    <div class="bs-stepper-content">
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane active dstepper-block" aria-labelledby="stepper1trigger1">
                            @livewire('front-end.partner.account-activation.business-details')
                        </div>
                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                            @livewire('front-end.partner.account-activation.representative-details')
                        </div>
                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                            @livewire('front-end.partner.account-activation.bank-details')
                        </div>
                        <div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
                            @livewire('front-end.partner.account-activation.terms-and-agreement')
                        </div>
                        <div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger5">
                            @livewire('front-end.partner.account-activation.acceptance')
                        </div>
                    </div>
                    <!-- /. END OF STEPPER CONTENT -->
                </div> 
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection
@section('js')
<script type="text/javascript">
    var stepper1
    document.addEventListener('DOMContentLoaded', function () {
        stepper1    = new Stepper(document.querySelector('#stepper1'));
        var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'));

        btnNextList.forEach(function (btn) {
            btn.addEventListener('click', function () {
                stepperForm.next();
            });
        });

        $(document).on('click', '.bs-stepper-previous', function () {
            stepper1.previous();
        });

        @if($step_to)
            stepper1.to({{$step_to}});
        @endif
    });
</script>
@endsection