<!-- CREATE SCHEDULE -->

    <!-- EDIT -->
    <div class="modal fade" id="modal-edit-schedule" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal-edit-schedule-title" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-schedule-title">Edit Exam Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="class-body">
                    <form id="formEditSchedule">
                        <div class="form-row align-items-center px-4">
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="editScheduleExam">Exam</label>
                            <input type="hidden" class="form-control" id="editScheduleId" name="editScheduleId">
                            <span class="invalid-feedback" id="error-editScheduleId" role="alert"></span>
                            <select name="editScheduleExam" id="editScheduleExam" class="form-control">
                                <option value="" selected>Select Exam</option>
                                @foreach ($schedule_exams as $exam)
                                    <option value="{{$exam->id}}">{{$exam->month}} {{$exam->year}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" id="error-editScheduleExam" role="alert"></span>
                          </div>
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="editScheduleSubject">Subejct</label>
                            <select name="editScheduleSubject" id="editScheduleSubject" class="form-control">
                                <option value="" selected>Select Subject</option>
                              @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                            </select>
                            <span class="invalid-feedback" id="error-editScheduleSubject" role="alert"></span>
                          </div>
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="editScheduleExamType">Exam Type</label>
                            <select name="editScheduleExamType" id="editScheduleExamType" class="form-control">
                                <option value="" selected>Select Exam Type</option>
                              @foreach ($exam_types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                              @endforeach
                            </select>
                            <span class="invalid-feedback" id="error-editScheduleExamType" role="alert"></span>
                          </div>
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="editScheduleExamDate">Date</label>
                            <input type="date" name="editScheduleExamDate" id="editScheduleExamDate" class="form-control"/>
                            <span class="invalid-feedback" id="error-editScheduleExamDate" role="alert"></span>
                          </div>
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="editScheduleStartTime">Start Time</label>
                            <input type="time" name="editScheduleStartTime" id="editScheduleStartTime" class="form-control"/>
                            <span class="invalid-feedback" id="error-editScheduleStartTime" role="alert"></span>
                          </div>
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="editScheduleEndTime">End Time</label>
                            <input type="time" name="editScheduleEndTime" id="editScheduleEndTime" class="form-control"/>
                            <span class="invalid-feedback" id="error-editScheduleEndTime" role="alert"></span>
                          </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-outline-primary" id="btnModalEditSchedule" onclick="edit_schedule();">Apply Changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /EDIT -->

    {{-- APPROVAL DECLINED MESSAGE --}}
    <div class="modal fade" id="modal-schedule-declined-message" data-backdrop="static" tabindex="-1" aria-labelledby="modal-schedule-declined-message-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 Schedule class="modal-title" id="modal-schedule-declined-message-title">Schedule Declined Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row align-items-center">
                        <div class="form-group col-12">
                            <textarea class="form-control" name="scheduleDeclineMessage" id="scheduleDeclineMessage" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                </div>
            </div>
        </div>
    </div>
    {{-- /APPROVAL DECLINED MESSAGE --}}

<!-- /CREATE SCHEDULE -->


<!-- SCHEDULE TABLE -->

    <!-- POSTPONE-->
    <div class="modal fade" id="modal-postpone-schedule" data-backdrop="static" tabindex="-1" aria-labelledby="modal-postpone-schedule-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-postpone-schedule-title">Postpone Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formPostponeSchedule">
                        <div class="form-row align-items-center">
                            <div class="form-group col-4">
                                <label for="postponeExamDate">Date</label>
                                <input type="hidden" class="form-control" id="postponeExamId" name="postponeExamId" />
                                <span class="invalid-feedback" id="error-postponeExamId" role="alert"></span>
                                <input type="date" class="form-control" name="postponeExamDate" id="postponeExamDate" />
                                <span class="invalid-feedback" id="error-postponeExamDate" role="alert"></span>
                            </div>
                            <div class="form-group col-4">
                                <label for="postponeExamStartTime">Start Time</label>
                                <input type="time" class="form-control" name="postponeExamStartTime" id="postponeExamStartTime" />
                                <span class="invalid-feedback" id="error-postponeExamStartTime" role="alert"></span>
                            </div>
                            <div class="form-group col-4">
                                <label for="postponeExamEndTime">End Time</label>
                                <input type="time" class="form-control" name="postponeExamEndTime" id="postponeExamEndTime" />
                                <span class="invalid-feedback" id="error-postponeExamEndTime" role="alert"></span>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-outline-primary" id="btnModalPostponeExam" onclick="postpone_exam();">Apply Changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /POSTPONE -->

<!-- /SCHEDULE TABLE -->