<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();
        if($students->count() > 0){
            return response()->json(
                [
                    'status' => 200,
                    'students' => $students
                ], 200);
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'students' => 'No records found.'
                ], 404);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422
            );
        } else {
            //Check for duplicate email
            $count = Student::where('email', $request->email)->count();
            if(!$count) {
                $student = Student::create([
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                if($student) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Student information saved successfully.'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Unable to save data, please try again..'
                    ], 500);
                }
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Duplicate email, please try again..'
                ], 500);
            }

            
        }

    }

    public function show($id) {
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Student not found'
            ], 404);
        }
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422
            );
        } else {
            //Check for duplicate email
            $count = Student::where('email', $request->email)->where('id', '!=',  $id)->count();
            if(!$count){
                $student = Student::find($id);

                if($student) {
                    $student->update([
                        'name' => $request->name,
                        'course' => $request->course,
                        'email' => $request->email,
                        'phone' => $request->phone,
                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => 'Student information updated successfully.'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Unable to update data, please try again..'
                    ], 404);
                }
            } else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Duplicate email, please try again..'
                ], 404);
            }
            
        }
    }

    public function destroy($id) {
        $student = Student::find($id);
        if($student) {
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student data deleted successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Unable to delete data, please try again..'
            ], 404);
        }
    }

}
