<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Student\hasExam;
use App\Models\Support\Fee;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class ExamsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('revalidate');
      $this->middleware('student.auth');
      $this->middleware('active.registration');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $today = Carbon::today();

    // $schedules=Schedule::orderby('date')->take(6)->get();
    $exams_to_apply = Fee::where('purpose', 'exam')->get();
    $exams = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->get();
    $student = Student::where('user_id',Auth::user()->id)->first();
    $selected_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', null)->where('payment_id', null)->get();
    $applied_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', null)->where('payment_id', '!=', null)->get();
    $scheduled_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', '!=' , null)->get();
    $absent_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', '!=', null)->where('status', 'AB' )->get();
    
    return view('portal/student/exams',[
      // 'schedules' => $schedules,
      'exams' =>$exams,
      'exams_to_apply' => $exams_to_apply,
      'student' => $student,
      'selected_exams' => $selected_exams,
      'applied_exams' => $applied_exams,
      'scheduled_exams' => $scheduled_exams,
      'absent_exams' => $absent_exams
    ]);
  }

  public function selectStudentExams(Request $request)
  {
    // $checked_exam_array = $request->applyExamCheck;
    $exams_to_apply = Fee::where('purpose', 'exam')->get();
    $student_id = Auth::user()->student->id;
    // echo $exams_to_apply;

    if ( $request->all() == NULL ):
      return response()->json(['status'=>'unselected']);
    else:
      foreach ($exams_to_apply as $exam_to_apply) :
        // echo $exam_to_apply;
        $id = $exam_to_apply->id;
        $requested_month = $id.'-requestedExam';
          
        if ( $request->$id == 1 ) :
          // echo $request->$id;
          if ( $request->$requested_month ) :
            // echo $request->$requested_month;
  
            $similar_exam = hasExam::where( 'student_id', $student_id )
                              ->where( 'subject_id', $exam_to_apply->subject_id )
                              ->where( 'exam_type_id', $exam_to_apply->exam_type_id )
                              ->where( 'requested_exam_id', $request->$requested_month )
                              ->first(); 

            $same_exam = hasExam::where( 'student_id', $student_id )
                                ->where( 'subject_id', $exam_to_apply->subject_id )
                                ->where( 'exam_type_id', $exam_to_apply->exam_type_id )
                                ->where( 'exam_schedule_id', null )
                                ->where( 'mark', null )
                                ->first(); 
  
            $passed_exam = hasExam::where( 'student_id', $student_id )
                              ->where( 'subject_id', $exam_to_apply->subject_id )
                              ->where( 'exam_type_id', $exam_to_apply->exam_type_id )
                              ->where( 'result', 1 )
                              ->first(); 
            // echo $similar;
            if( $similar_exam != Null || $same_exam != Null ):
              return response()->json(['status'=>'exist']);
            else:
              if( $passed_exam != Null ):
                return response()->json(['status'=>'passed']);
              else:
                $applied_exam = new hasExam();
      
                $applied_exam->student_id = $student_id;
                $applied_exam->subject_id = $exam_to_apply->subject_id;
                $applied_exam->exam_type_id = $exam_to_apply->exam_type_id;
                $applied_exam->requested_exam_id = $request->$requested_month;
      
                $applied_exam->save();

              endif;
            endif;
  
          else:
            return response()->json(['status'=>'nomonth']);
          endif;
        else:
        endif;
      endforeach;
      return response()->json(['status'=>'success']);
    endif;



    // Check if exams are selected
    // if($checked_exam_array == null):
    //   return response()->json(['status'=>'unselected']);
    // else:
    //   foreach($request->applySubject as $key=>$value):
    //     if(in_array($request->applySubject[$key], $checked_exam_array)):
    //       $applied_exam = new hasExam();
    //       $subject = Fee::where('id',$request->applySubject[$key])->first();

    //       $applied_exam->student_id = $request->student_id;
    //       $applied_exam->subject_id = $subject->subject_id;
    //       $applied_exam->exam_type_id = $request->applyExamType[$key];
    //       $applied_exam->requested_exam_id = $request->requestedExam[$key];
    //       $applied_exam->save();
    //     endif;
    //   endforeach;
    //   return response()->json(['status'=>'success']);
    // endif;

    // dd($request->all());
  }

  public function deleteStudentExams(Request $request)
  {
    if(hasExam::where('id', $request->student_exam_id)->forceDelete()):
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=>'error']);
  }

  public function examPayment()
  {
    $student = Auth::user()->student;
    $selected_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', null)->where('payment_id', null)->get();
    $total_amount = null;
    foreach ($selected_exams as $selected_exam) {
      $total_amount = $total_amount+Fee::select('amount')->where('subject_id', $selected_exam->subject->id)->where('exam_type_id', $selected_exam->type->id)->first()->amount;
    }
    
    return view('portal/student/payment/exam', [
      'student'=> $student,
      'exam_details'=>$selected_exams,
      'total_amount'=>$total_amount,
    ]);
  } 
  
  public function saveExamPayment(Request $request)
  {
    $validator = Validator::make($request->all(), 
      [     
          'paidBank'=> ['required'],
          'paidBankCode'=>['required'],
          'paidDate'=>['required', ],
          'paidAmount'=>['required', 'numeric']
      ]
    );
    if($validator->fails()):
      return response()->json(['errors'=>$validator->errors()]);
    else:

    endif;
  }
}
