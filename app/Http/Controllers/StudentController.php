<?php

namespace App\Http\Controllers;

use App\Models\Student;
//use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Image;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('students');
    }
    public function fetchstudent()
    {
        $students=Student::all();
        return response()->json([
            'students'=>$students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
//        $validator=Validator::make($request->all(),[
//            'name'=>'required|max:191',
//            'email'=>'required|email|max:191',
//            'phone'=>'required|max"191',
//            'course'=>'required|max:191'
//        ]);
//        if ($validator->fails())
//        {
//            return response()->json([
//                'status'=>400,
//                'errors'=>$validator->messages(),
//            ]);
//        }
//        else{
            $student=new Student;
            $student->name=$request->input('name');
            $student->email=$request->input('email');
            $student->phone=$request->input('phone');
            $student->course=$request->input('course');

        if($request->hasFile('image')){
            $completeFileName=$request->file('image')->getClientOriginalName();
            // dd($completeFileName);
            $fileNameOnly=pathinfo($completeFileName,PATHINFO_FILENAME);
            $extenshion=$request->file('image')->getClientOriginalExtension();
            // dd($extenshion);
            $comPic=str_replace('','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extenshion;
            // dd($comPic);
            $path=$request->file('image')->storeAs('public/posts',$comPic);
            $student->image=$comPic;
        }
//        if($student->save()){
//            return['status'=>true,'message'=>'Post saved successfully'];
//        }
//        else{
//            return['status'=>false,'message'=>'Something went wrong'];
//        }

            $student->save();
            return response()->json([
                'status'=>200,
                'message'=>'Student Added Successfully',
          ]);
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $student=Student::find($id);
        if ($student){
            return response()->json([
                'status'=>200,
                'student'=>$student,
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Student not found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $student=Student::find($id);
        if ($student){
            $student->name=$request->input('name');
            $student->email=$request->input('email');
            $student->phone=$request->input('phone');
            $student->course=$request->input('course');
            $student->update();
            return response()->json([
                'status'=>200,
                'message'=>'Student Updated Successfully',
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Student not found',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $student=Student::where('id',$id)->first();
        $student->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Student Deleted Successfully',
        ]);
    }

    public function autocomplete(Request $request){
        $datas=Student::select("name")
            ->where("name","LIKE","%{$request->terms}%")
            ->get();
        return response()->json($datas);
    }
}
