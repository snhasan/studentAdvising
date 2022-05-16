<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Advising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){

        return view('dashboard.index');
    }

    public function courses(){

        return view('dashboard.courses');
    }

    public function getCourses(){

        return response()->json(Course::where('IsActive',1)->whereDate('date', '>=', Carbon::now())->get());
    }

    public function searchedCourses(Request $request){

        return response()->json(Course::where('IsActive',1)->where('course_title','like', '%' . $request->searchQuery . '%')
                                                            ->orWhere('class_code','like', '%' . $request->searchQuery . '%')
                                                            ->whereDate('date', '>=', Carbon::now())->get());
    }

    public function addCourse(Request $request)
    {
        $uid = Auth::id();

        $course  = new Course();
        $course->course_title = $request->course_title;
        $course->class_code = $request->class_code;
        $course->date = $request->date;
        $course->room_no = $request->room_no;
        $course->building_no = $request->building_no;
        $course->IsActive = 1;
        $course->created_by = $uid;
        $course->created_at = Carbon::now()->timestamp;

        $course->save();

        return response()->json($course);
    }

    public function deleteCourse($id)
    {
        $course = Course::find($id);

        $course->IsActive = 0;
        $course->update();

        return response()->json('success');
    }

    public function updateCourse($id, Request $request)
    {
        $course = Course::find($id);

        $course->course_title = $request->course_title;
        $course->class_code = $request->class_code;
        $course->date = $request->date;
        $course->room_no = $request->room_no;
        $course->building_no = $request->building_no;
        $course->updated_at = Carbon::now()->timestamp;

        $course->save();

        return response()->json($course);

    }

    public function enrollCourse($id, Request $request)
    {
        $enrolled = Advising::where('student_id', $request->profile_id)
                            ->where('course_id',$id)
                            ->first();

        if($enrolled === null){

            $advising  = new Advising();
            $advising->course_title = $request->course_title;
            $advising->class_code = $request->class_code;
            $advising->course_id = $id;
            $advising->student_id = $request->profile_id;
            $advising->IsActive = 1;
            $advising->created_at = Carbon::now()->timestamp;

            $advising->save();

            return response()->json('Successfully Enrolled!');
        }
        else{
            return response()->json('Already Enrolled');
        }
        

    }
}
