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
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $today = Carbon::today();

    $schedule=Schedule::orderby('date')->take(6)->get();
    $exams_to_apply = Fee::where('purpose', 'exam')->get();
    $exams = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->get();
    $student = Student::where('user_id',Auth::user()->id)->first();
    
    return view('portal/student/exams',[
      'schedule' => $schedule,
      'exams' =>$exams,
      'exams_to_apply' => $exams_to_apply,
      'student' => $student
    ]);
  }

  public function applyForExams(Request $request)
  {
    $checked_exam_array = $request->applyExamCheck;
    foreach($request->applySubject as $key=>$value):
      if(in_array($request->applySubject[$key], $checked_exam_array)):
        $applied_exam = new hasExam();
        $subject = Fee::where('id',$request->applySubject[$key])->first();
        
        $applied_exam->exam_schedule_id = 1;
        $applied_exam->student_id = $request->student_id;
        $applied_exam->subject_id = $subject->subject_id;
        $applied_exam->exam_type_id = $request->applyExamType[$key];
        $applied_exam->requested_exam_id = $request->requestedExam[$key];
        $applied_exam->payment_id = 1;
        $applied_exam->save();
      endif;
    endforeach;
    return response()->json(['status'=>'success']);

    // dd($request->all());
  }
}
