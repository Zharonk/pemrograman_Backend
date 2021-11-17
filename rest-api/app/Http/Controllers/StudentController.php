<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();

        $data =
        [
            'message' => "get all students",
            'data' => $students

        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $input= [
            'nama'  =>  $request->nama,
            'nim'   =>  $request->nim,
            'email' =>  $request->email,
            'jurusan'   => $request->jurusan
        ];

        $student = Student::create($input);

        $data = [
            'message' => "data berhasil ditambahkan",
            'data'=>$student
        ];

        return response()->json($data, 201);
    }

    public function show($id){
        $student = Student::find($id);
        if ($student){
            $data = [
                'message' => 'get detail student',
                'data' => $student
            ];
            return response()->json($data,200);
        }
        else{
            $data = [
                'message' => 'data is not found'
            ];
            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id){
        $student = Student::find($id);
        if($student){
            $input = [
                'nama'=>$request->nama ??  $student->nama,
                'nim'=>$request->nim ?? $student->nim, //jika data request dari nimnya ada maka ambil, klo gk ada requestnya maka pake yg nim awal (dari student)
                'email'=>$request->email ??  $student->email,
                'jurusan'=>$request->jurusan ??  $student->jurusan,

            ];

            $student->update($input);

            $data = [
                'message' => 'data is updated',
                'data'=>$student
            ];

            return response()->json($data,200);
        }
        else{
            $data = [
                'message' => 'data is not found'
            ];
            return response()->json($data, 404);
        }
    }

    public function destroy($id){
        $student = Student::find($id);
        if ($student){
            $student->delete();

            $data = [
                'message' => 'data is deleted'
            ];

            return response()->json($data, 200);
        }
        else{
            $data = [
                'message' => ' data is not found'
            ];

            return response()->json($data, 404);
        }
    }
}
