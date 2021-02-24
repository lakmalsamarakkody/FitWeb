<!-- VIEW EXAM APPLICATION DETAILS -->
<div class="modal fade" id="modal-view-exam-application" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewExamApplication" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewExamApplication"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="card shadow-none">
                    <div class="card-header pb-0">Exam Application</div>
                    <div class="card-body pb-0">                        
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-left">
                                    <tr>
                                        <th>Submitted on: </th>
                                        <td><span id="spanSubmittedOn"></span> <small class="text-muted">(MM/DD/YY)</small></td>                                        
                                    </tr>
                                    <tr>
                                        <th>Type: </th>
                                        <td>Exam</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- APPROVED STATUS --}}
                <div class="card shadow-none">
                    <div class="card-header pb-0">Approval Status</div>
                    <div class="card-body pb-0 text-main-theme">                        
                        <div class="row">
                            <div class="col-lg-4">Details : <i id="iconDetailStatus" class="fas"></i> <span id="spanDetailStatus"></span></div>
                            <div class="col-lg-4">Payment : <i id="iconPaymentStatus" class="fas"></i> <span id="spanPaymentStatus"></span></div>
                            <div class="col-lg-4">Documents : <i id="iconDocumentsStatus" class="fas"></i> <span id="spanDocumentsStatus"></span></div>
                        </div>
                    </div>
                </div>
                {{-- /APPROVED STATUS --}}

                <h6 class="card-header mt-4 mb-2">Applied Exams Information</h6>

                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="col-lg-12 examInformation">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                Applied Exams
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 order-md-1 order-2">
                                                        <table id="tblExams" class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Subject Code</th>
                                                                    <th>Subject Name</th>
                                                                    <th>Exam Type</th>
                                                                    <th>Requested Exam</th>
                                                                    <th>Scheduled Exam</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($applied_exams as $exam)
                                                                <tr>
                                                                    <td>{{ $exam->subject_id }}</td>
                                                                    <td>{{ $exam->subject_id }}</td>
                                                                    <td>{{ $exam->exam_type_id }}</td>
                                                                    <td>{{ $exam->requested_exam_id }}</td>
                                                                    {{-- <td>{{ \Carbon\Carbon::createFromDate($exam->schedule->exam->year, $exam->schedule->exam->month)->monthName }} {{ $exam->schedule->exam->year }}</td> --}}
                                                                    <td>@if($exam->exam_schedule_id == null)Not yet scheduled @else {{ $exam->schedule->date }}@endif</td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-outline-primary" id="btnScheduleAppliedExam-{{$exam->id}}" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Schedule Exam"><i class="fas fa-calendar-alt"></i></button>
                                                                            <button type="button" class="btn btn-outline-warning" id="btnDeclineAppliedExam" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Decline Exam"><i class="fas fa-times-circle"></i></button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                                <div id="divBtnApproveAppliedExams" class="btn-group col-xl-3 col-lg-6">
                                    <button type="button" class="btn btn-success form-control" id="btnApproveAppliedExams">Send Schedules to Student<span id="spinnerBtnApproveAppliedExam" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                                <div id="divBtnDeclineAppliedExams" class="btn-group col-xl-3 col-lg-6">
                                    <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-exams-message" id="btnDeclineAppliedExams" data-toggle="modal">Decline Applied Exams<span id="spinnerBtnDeclineAppliedExam" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            <div class="col-12 order-md-1 order-2">
                                                <table class="table text-left">
                                                    <tr>
                                                        <th>Date: </th>
                                                        <td><span id="spanPaymentDate"></span></td>                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank: </th>
                                                        <td><span id="spanPaymentBank"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank Branch: </th>
                                                        <td><span id="spanPaymentBankBranch"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank Branch Code: </th>
                                                        <td><span id="spanPaymentBankBranchCode"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Amount: </th>
                                                        <td>Rs.<span id="spanPaymentAmount"></span></td>
                                                    </tr>
                                                </table>
                                                <div name="imgPaymentBankSlip" id="imgPaymentBankSlip" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header">Medicals</div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            @foreach ($applied_exams as $exam)
                                            <div class="col-md-12 order-md-1 order-2">
                                                <table id="tblMedicals" class="table">
                                                    <tr>
                                                        <th>Subject Code: </th>
                                                        <td><span id="spanSubjectCode"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Subject Name: </th>
                                                        <td><span id="spanSubjectName"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Exam Held Date: </th>
                                                        <td><span id="spanExamHeldDate"></span></td>
                                                    </tr>
                                                </table>
                                                <div class="col-lg-12">
                                                    <div name="imgMedical" id="imgMedical" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                                </div>
                                                <div class="mt-4 col-12 text-center mb-4">
                                                    <div id="divBtnApproveMedical" class="btn-group col-xl-3 col-lg-6">
                                                        <button type="button" class="btn btn-success form-control" id="btnApproveMedical">Approve Medical<span id="spinnerBtnApproveMedical" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                                    </div>
                                                    <div id="divBtnDeclineMedical" class="btn-group col-xl-3 col-lg-6">
                                                        <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-medical-message" id="btnDeclineMedical" data-toggle="modal">Decline Medical<span id="spinnerBtnDeclineMedical" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                                    </div>
                                                </div>
                                                <hr width="100%"/>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCheckLater" data-dismiss="modal">Check Later</button>
            </div>
        </div>
    </div>

</div>
<!-- /VIEW EXAM APPLICATION DETAILS -->