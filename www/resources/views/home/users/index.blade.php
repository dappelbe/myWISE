@extends('layouts.secured')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card bg-success border-success ">
                <div class="card-header d-flex border-success" >
                    <div class="row">
                        <div class="col-12">
                            <h3>Welcome {{Auth::user()->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body  bg-white border-success">
                    <div class="row">
                        <div class="col-12">
                            @if( $numweeks == 0 )
                                There is an exercise planner for you to complete your goals and exercise plan with your therapist
                            @else
                                Congratulations on getting to the {{$numweeks}}@if( $numweeks == 1 )<sup>st</sup> @elseif ($numweeks == 2)<sup>nd</sup>@elseif ($numweeks == 3)<sup>rd</sup>@else<sup>th</sup>@endif week of the WISE programme!
                                <br/>
                                We now ask you to review your goals and exercise plan using the form below.
                                <br/>
                                If you have achieved your previous goal, try a new goal now. You can also change your goal, even if you have not achieved it. Write down your new SMART goal in the form below.
                                <br/>
                                You can also modify your exercise plan of 'when' and 'where' to do the exercises.
                                <br/>
                                If you don't want to change anything, skip this form.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            &#160;
        </div>
    </div>

    <div class="row">
        <div class="col-5">
            <div class="card border-blue">
                <div class="card-header d-flex border-blue bg-blue">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="text-white">Your Exercise Plans</h3>
                        </div>
                        <div class="col-2 text-right">
                            @if( $numweeks > count($plans) || $numweeks == 0)
                                <button type="button" class="btn btn-block btn-primary mb-3" data-toggle="modal" data-target="#modal-default">Add Plan</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body border-blue">
                    <div class="row">
                        <div class="col-12">
                            <div id="accordion">

                                @if( count($plans) == 0 )
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Please Enter your exercise plan
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach( $plans as $plan )
                                        @if( $loop->last )
                                            <div class="card">
                                                <div class="card-header" id="heading{{$plan->id}}">
                                                    <h5 class="mb-0">
                                                        @if( count($plans) == 1 )
                                                            Plan {{ $loop->count - $loop->iteration +1 }} ({{date("d-M-Y", strtotime("$plan->created_at"))}})
                                                        @else
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$plan->id}}" aria-expanded="true" aria-controls="collapse{{$plan->id}}">
                                                                Plan {{ $loop->count - $loop->iteration +1 }} ({{date("d-M-Y", strtotime("$plan->created_at"))}})
                                                            </button>
                                                        @endif
                                                    </h5>
                                                </div>
                                                @if( count($plans) == 1 )
                                                    <div id="collapse{{$plan->id}}" class="show" aria-labelledby="heading{{$plan->id}}" data-parent="#accordion">
                                                @else
                                                    <div id="collapse{{$plan->id}}" class="collapse hide" aria-labelledby="heading{{$plan->id}}" data-parent="#accordion">
                                                @endif
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                My Long term goal is
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->ltgoal}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                My short-term SMART goal is
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->smartgoal}}
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <strong>My Exercise Plan is:</strong>
                                                            </div>
                                                            <div class="col-6">
                                                                I will do my exercises at (for example, dining table):
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->exwhere}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                I will do my exercises during (time or other period in the day, for example, coffee time):
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->exwhen}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                If I cannot do them at this time, I will do them:
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->exalternative}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                Therapist Name:
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->physioname}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="card">
                                                <div class="card-header" id="heading{{$plan->id}}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$plan->id}}" aria-expanded="true" aria-controls="collapse{{$plan->id}}">
                                                            Plan {{ $loop->count - $loop->iteration +1 }} ({{date("d-M-Y", strtotime("$plan->created_at"))}})
                                                        </button>
                                                    </h5>
                                                </div>
                                                @if( $loop->first )
                                                <div id="collapse{{$plan->id}}" class="collapse show" aria-labelledby="heading{{$plan->id}}" data-parent="#accordion">
                                                    @else
                                                        <div id="collapse{{$plan->id}}" class="collapse hide" aria-labelledby="heading{{$plan->id}}" data-parent="#accordion">
                                                    @endif
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                Previous Goal Achieved:
                                                            </div>
                                                            <div class="col-6">
                                                                @if( $plan->previousachieved < 0 )
                                                                    N/A
                                                                @elseif( $plan->previousachieved == 0 )
                                                                    <span class="text-danger">No</span>
                                                                @else
                                                                    <span class="text-success">Yes</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                My Long term goal is
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->ltgoal}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                My short-term SMART goal is
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->smartgoal}}
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <strong>My Exercise Plan is:</strong>
                                                            </div>
                                                            <div class="col-6">
                                                                I will do my exercises at (for example, dining table):
                                                            </div>
                                                            <div class="col-6">
                                                                {{$plan->exwhere}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                I will do my exercises during (time or other period in the day, for example, coffee time):
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->exwhen}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                If I cannot do them at this time, I will do them:
                                                            </div>
                                                            <div class="col-6 ">
                                                                {{$plan->exalternative}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="text-blue">Your Exercise Diary</h3>
                            <ol>
                                <li><button class="btn btn-sm btn-success">Diary Entry Complete</button></li>
                                <li><button class="btn btn-sm btn-warning">Diary Entry either Strengthening OR Stretching not completed</button></li>
                                <li><button class="btn btn-sm btn-danger">Diary Entry incomplete</button></li>
                            </ol>
                            <p>
                                Click on the day that you wish to complete an entry for
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ( $diaryData as $week => $data )
                    <div class="row">
                        <div class="col-3">
                            Week {{ $week }}
                        </div>
                        <div class="col-9">
                            @foreach( $data as $day => $entry)
                                @if( $entry->stretchingdone == '-1' && $entry->strengtheningdone == '-1' )
                                    <button class="btn btn-sm btn-danger"
                                            data-target="#modal-daily"
                                @elseif ( $entry->stretchingdone == '0' || $entry->strengtheningdone == '0' )
                                    <button class="btn btn-sm btn-warning"
                                            data-target="#modal-daily-view"
                                @else
                                    <button class="btn btn-sm btn-success"
                                            data-target="#modal-daily-view"
                                @endif
                                        data-id="{{$entry->id}}"
                                            data-userid="{{$entry->userid}}"
                                            data-week="{{$entry->week}}"
                                            data-day="{{$entry->day}}"
                                            data-calcdate="{{$entry->calcdate}}"
                                            data-stretchingdone="{{$entry->stretchingdone}}"
                                            data-strengtheningdone="{{$entry->strengtheningdone}}"
                                            data-notes="{{$entry->notes}}"
                                            data-toggle="modal"
                                    >Day {{$day}} ({{date("d-M-Y", strtotime("$entry->calcdate"))}}) </button>
                            @endforeach
                        </div>
                    </div>
                        <br/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            &#160;
        </div>
    </div>

    <!-- =========================================================================== -->
    <!-- Modal to add a new plan                                                     -->
    <!-- =========================================================================== -->
        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    {{ Form::open(['route' => 'home.user.addPlan', 'class' => 'needs-validation', 'novalidate' =>'']) }}
                    <input type="hidden" id="id" name="id" value="0" />
                    <input type="hidden" id="userid" name="userid" value="-1" />
                    <input type="hidden" id="repeatnum" name="repeatnum" value="-1" />
                    <input type="hidden" id="physioname" name="physioname" value=" " />
                    <input type="hidden" id="ltgoal" name="ltgoal" value=" " />
                        <div class="modal-header bg-warning">
                            <h2 class="h6 modal-title">Add a New Exercise Plan</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 mt-4 mt-md-0">
                                    <label>Previous goal achieved <span id="lastGoal"></span>?</label>
                                </div>
                                <div class="col-6 mt-4 mt-md-0">
                                    Yes <input class="form-check-input" type="radio" name="previousachieved" id="previousachieved_y" value="1" required>
                                    &#160; &#160; No <input class="form-check-input" type="radio" name="previousachieved" id="previousachieved_n" value="0">
                                    <div class="invalid-feedback">
                                        Please provide an Answer.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4 mt-md-0">
                                    <label>My new short-term SMART goal is</label>
                                    <input type="text" class="form-control" id="smartGoal" name="smartgoal" aria-describedby="smartGoalHelp" required>
                                    <div class="invalid-feedback">
                                        Please provide a SMART goal.
                                    </div>
                                    <small id="smartGoalHelp" class="form-text text-muted">If you have achieved your previous goal, try a new goal now. You can also change your goal, even if you have not achieved it. </small>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-12 mt-4 mt-md-0">
                                    <div class="alert alert-warning text-black" role="alert">
                                        <strong>My new exercise plan is:</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4 mt-md-0">
                                    <label>1. I will do my exercises at (for example, dining table): </label>
                                    <input type="text" class="form-control" id="exwhere" name="exwhere" aria-describedby="smartGoalHelp" required>
                                    <div class="invalid-feedback">
                                        Please say where you will do your exercises
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4 mt-md-0">
                                    <label>2. I will do my exercises during (time or other period in the day, for example, coffee time)</label>
                                    <input type="text" class="form-control" id="exwhen" name="exwhen" aria-describedby="smartGoalHelp" required>
                                    <div class="invalid-feedback">
                                        Please say what time of day you will do your exercises
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4 mt-md-0">
                                    <label>If I cannot do them at this time, I will do them</label>
                                    <input type="text" class="form-control" id="exalternative" name="exalternative" aria-describedby="smartGoalHelp" required>
                                    <div class="invalid-feedback">
                                        Please answer
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" id="addPlan.Submit" class="btn btn-sm btn-success" value="Add Plan"/>
                            <button type="button" class="btn btn-link text-danger ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    <!-- =========================================================================== -->
    <!-- Modal to record/view a diary entry                                          -->
    <!-- =========================================================================== -->
    <div class="modal fade" id="modal-daily" tabindex="-1" role="dialog" aria-labelledby="modal-daily" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {{ Form::open(['route' => 'home.user.addDiary', 'class' => 'needs-validation', 'novalidate' =>'']) }}
                <input type="hidden" id="diary-id" name="id" value="0" />
                <input type="hidden" id="diary-userid" name="userid" value="-1" />
                <input type="hidden" id="diary-week" name="week" value="-1" />
                <input type="hidden" id="diary-day" name="day" value=" " />
                <input type="hidden" id="diary-calcdate" name="calcdate" value=" " />
                <div class="modal-header bg-warning">
                    <h2 class="h6 modal-title">On <span id="diary-ondate"></span> did you ....</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mt-4 mt-md-0">
                            <label>complete your stretching exercises?</label>
                        </div>
                        <div class="col-6 mt-4 mt-md-0">
                            Yes <input class="form-check-input" type="radio" name="stretchingdone" id="diary-stretchingdone_y" value="1" required>
                            &#160; &#160; No <input class="form-check-input" type="radio" name="stretchingdone" id="diary-stretchingdone_n" value="0">
                            <div class="invalid-feedback">
                                Please provide an Answer.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-4 mt-md-0">
                            <label>complete your strengthening exercises?</label>
                        </div>
                        <div class="col-6 mt-4 mt-md-0">
                            Yes <input class="form-check-input" type="radio" name="strengtheningdone" id="diary-strengtheningdone_y" value="1" required>
                            &#160; &#160; No <input class="form-check-input" type="radio" name="strengtheningdone" id="diary-strengtheningdone_n" value="0">
                            <div class="invalid-feedback">
                                Please provide an Answer.
                            </div>
                        </div>
                    </div>
                    <br/>

                    <div class="row">
                        <div class="col-12 mt-4 mt-md-0">
                            <label>Notes:</label>
                            <input type="text" class="form-control" id="diary-notes" name="notes">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="addDiary.Submit" class="btn btn-sm btn-success" value="Add Diary Entry"/>
                    <button type="button" class="btn btn-link text-danger ml-auto" data-dismiss="modal">Close</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

            <div class="modal fade" id="modal-daily-view" tabindex="-1" role="dialog" aria-labelledby="modal-daily" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h2 class="h6 modal-title">On <span id="diary-view-ondate"></span> you ....</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 mt-4 mt-md-0">
                                    <label>complete your stretching exercises?</label>
                                </div>
                                <div class="col-6 mt-4 mt-md-0" id="diary-view-stretch">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-4 mt-md-0">
                                    <label>complete your strengthening exercises?</label>
                                </div>
                                <div class="col-6 mt-4 mt-md-0" id="diary-view-strength">
                                </div>
                            </div>
                            <br/>

                            <div class="row">
                                <div class="col-12 mt-4 mt-md-0">
                                    <label>Notes:</label>
                                    <input type="text" class="form-control" id="diary-view-notes" name="notes" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-danger ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('pagejs')
   <script>
       $().ready(function(){
           let userid = {{$userid}};
           let repeatnum = {{count($plans) + 1}};
           let currentgoal = "{{ $lastgoal }}";

           $('#modal-default').on('show.bs.modal', function (e) {
               $('#smartGoal').val('');
               $('#exwhere').val('');
               $('#exwhen').val('');
               $('#exalternative').val('');

               $('#userid').val(userid);
               $('#repeatnum').val(repeatnum);
               $('#lastGoal').html(currentgoal);
           })

           //-- Diary Entry
           $('#modal-daily').on('show.bs.modal', function (event) {
               $('#diary-id').val($(event.relatedTarget).data('id'));
               $('#diary-userid').val($(event.relatedTarget).data('userid'));
               $('#diary-week').val($(event.relatedTarget).data('week'));
               $('#diary-day').val($(event.relatedTarget).data('day'));
               $('#diary-calcdate').val($(event.relatedTarget).data('calcdate'));
               $('#diary-ondate').html($(event.relatedTarget).data('calcdate'));
               $('#diary-stretchingdone_y').prop( "checked", false );
               $('#diary-stretchingdone_n').prop( "checked", false );
               $('#diary-strengtheningdone_y').prop( "checked", false );
               $('#diary-strengtheningdone_n').prop( "checked", false );
               $('#diary-notes').val($(event.relatedTarget).data('notes'));
           })

           //-- Diary View
           $('#modal-daily-view').on('show.bs.modal', function (event) {
               $('#diary-view-ondate').html($(event.relatedTarget).data('calcdate'));
               if ( $(event.relatedTarget).data('stretchingdone') == '1') {
                   $('#diary-view-stretch').html('Yes');
               } else {
                   $('#diary-view-stretch').html('No');
               }

               if ( $(event.relatedTarget).data('strengtheningdone') == '1') {
                   $('#diary-view-strength').html('Yes');
               } else {
                   $('#diary-view-strength').html('No');
               }
               $('#diary-view-notes').val($(event.relatedTarget).data('notes'));
           })

       });

       (function () {
           'use strict'

           // Fetch all the forms we want to apply custom Bootstrap validation styles to
           let forms = document.querySelectorAll('.needs-validation')

           // Loop over them and prevent submission
           Array.prototype.slice.call(forms)
               .forEach(function (form) {
                   form.addEventListener('submit', function (event) {
                       if (!form.checkValidity()) {
                           event.preventDefault()
                           event.stopPropagation()
                       }

                       form.classList.add('was-validated')
                   }, false)
               })
       })()

   </script>
@endsection
