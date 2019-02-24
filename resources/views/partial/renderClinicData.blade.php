@if(count($clinicData) > 0 )
    @foreach ($clinicData as $key=>$clinic)                                 
        <div id="accordion{{$key + 1 }}" role="tablist" data-accordion-theme="white" data-toggle-icon="arrow"
            data-accordion-style="border" class="card p-0 border mb-2">
            <div class="" role="tab" id="heading{{$key + 1 }}">
                <h5 class="mb-0">
                    <a data-toggle="collapse" href="#" role="button" aria-controls="collapse{{$key + 1 }}"
                        data-toggle="collapse" data-target="#collapse{{$key + 1 }}">
                        <div class="accordion__heading height-auto">
                            <div class="py-2">
                                <h6 class="primary-text mb-2">{{ $clinic->clinic_name }}</h6>
                                <span class="font-normal font-weight-normal text-muted d-inline-block position-relative pl-4 mr-4">
                                    <i class="ic-phone"></i>
                                    {{ $clinic->clinic_phone }}
                                </span>
                                <span class="font-normal font-weight-normal text-muted d-inline-block position-relative pl-4">
                                    <i class="ic-email"></i>
                                    {{ $clinic->clinic_email }}
                                </span>
                            </div>
                            <i class="toggle-icon">
                            </i>
                        </div>
                    </a>
                </h5>
            </div><!-- end accordion heading -->

            <div id="collapse{{$key + 1 }}" class="collapse divider-top" role="tabpanel"
                aria-labelledby="heading{{$key + 1 }}" data-parent="#accordion-parent">
                <div class="card-body p-0">
                    <form id="{{strtolower(str_replace(' ', '_', $clinic->clinic_name))}}_form_{{$key + 1 }}">
                    <input type="hidden" id="clinic_id_{{$key + 1 }}" name="clinic_id_{{$key + 1 }}" value="{{$clinic->id}}">
                        <div>
                            <div class="box [ mb-0 pt-4 pb-0 ] position-relative z-index-0">
                                <div class="row [ mb-4 ]">
                                    <div class="col-auto [ d-flex align-items-center ]">
                                        <div class="btn-group checkbox-group" data-toggle="buttons">
                                            <label class="btn">
                                                <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="1"> Mon
                                            </label>
                                            <label class="btn">
                                                <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="2"> Tue
                                            </label>
                                            <label class="btn">
                                                <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="3"> Wed
                                            </label>
                                            <label class="btn">
                                                <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="4"> Thu
                                            </label>
                                            <label class="btn">
                                                <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="5"> Fri
                                            </label>
                                            <label class="btn">
                                                <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="6"> Sat
                                            </label>
                                            <label class="btn">
                                                <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="7"> Sun
                                            </label>
                                            <div class="form-error day_error_{{$key + 1 }}">
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto [ pl-lg-0 pr-lg-0 pl-xl-3 pr-xl-3 ]">
                                        <div class="time-group">
                                            <div class="time-group__item bootstrap-timepicker">
                                                <input name="start_time_{{$key + 1 }}" type="text" class="form-control timepicker time-group__input start_time_{{$key + 1 }}"
                                                    placeholder="Start" />
                                            
                                            </div>
                                            <span class="mx-3">
                                                To
                                            </span>
                                            <div class="time-group__item bootstrap-timepicker">
                                                <input name="end_time_{{$key + 1 }}" type="text" class="form-control time-group__input timepicker end_time_{{$key + 1 }}"
                                                    placeholder="End" />
                                            </div>
                                        </div>
                                        <div class="form-error form-error--full start_time_error_{{$key + 1 }} end_time_error_{{$key + 1 }} time_error_{{$key + 1 }}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto [ pr-0 d-flex align-items-center ]">
                                        <button type="btn" class="btn btn-add book_slot"></button>
                                    </div>
                                </div>

                                
                                <div class="appointment-list divider-top">
                                    @if( count($clinic->clinicSlots) > 0 )
                                        @foreach ($clinic->clinicSlots as $numDay=>$clientSlotData)
                                            <div class="appointment-list__item">
                                                <div class="appointment-list__day">
                                                    {{ jddayofweek(($numDay - 1), 1)}}
                                                </div> 
                                                @foreach ($clientSlotData as $slot)
                                                    <div class="appointment-list__time">
                                                        <div class="badge badge-pill bg-light d-flex align-items-center secondary-text-dark ng-scope">
                                                            <span class="font-small font-weight-bold ng-binding">
                                                                {{ $slot['start_time'] }}
                                                            </span>
                                                            <span class="font-small px-2 text-muted">
                                                                To
                                                            </span>
                                                            <span class="font-small font-weight-bold ng-binding">
                                                                {{$slot['end_time']}}
                                                            </span>
                                                            <a data-id="{{$slot['slot_id']}}" class="ic-close ml-2 delete_slot" style="cursor : pointer">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div> <!-- /.appointment-list__item   -->
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end accordion body-->
        </div><!-- end accordion -->
    @endforeach
@endif

<script type="text/javascript">
    $('.timepicker').timepicker({
        template: false,
        showInputs: false,
        minuteStep: 5
    });
</script>