<?php

namespace App\Http\Controllers;

use App\Models\statusPatient;
use Illuminate\Http\Request;

class StatusPatientController extends Controller
{
    public function index()
    {
        // inisialisasi $statusPatients dengan static method all()
        $statusPatients = statusPatient::all();
        $message = '';
        $statusCode = 0;

        if (count($statusPatients) < 1) { // status kosong
            $statusPatients = [];
            $message = 'Data is empty';
            $statusCode = 200;
        } else { // ada status
            $statusPatients = $statusPatients;
            $message = 'Get All Resource';
            $statusCode = 200;
        }

        // membuat response
        $response = [
            'message' => $message,
            'status code' => $statusCode,
            'data' => $statusPatients
        ];

        return response()->json($response, $statusCode);
    }

    // add statusPatients
    public function store(Request $request)
    {
        // validasi status
        $val = $request->validate([
            'status' => 'required',
        ]);

        // memasukkan status kedalam table
        $patients = statusPatient::create($val);

        // membuat response
        $response = [
            'message' => 'Resource is added successfully',
            'status' => 201,
            'data' => $patients
        ];

        return response()->json($response, 201);
    }

    // menampilkan detail statusPatients
    public function show($id)
    {
        // inisialisasi $statusPatients dengan static method find($id)
        $statusPatients = statusPatient::find($id);


        if ($statusPatients) { // id ditemukan
            $detail = [
                'status' => $statusPatients->status
            ];

            $response = [
                'message' => 'Get Detail Resource',
                'status' => 200,
                'data' => $detail
            ];

            return response()->json($response, 200);
        } else { // id tidak ditemukan
            $response = [
                'message' => 'Resource not found',
                'status' => 404,
            ];

            return response()->json($response, 404);
        }
    }

    // mengupdate statusPatients
    public function update(Request $request, $id)
    {
        // inisialisasi $statusPatients dengan static method find($id)
        $statusPatients = statusPatient::find($id);
        $message = '';
        $statusCode = 0;

        if ($statusPatients) { // id ditemukan
            $statusPatients = $statusPatients;

            $input = $request->validate([
                'status' => 'string'
            ]);

            // mengupdate statusPatients dengan method update
            $statusPatients->update($input);

            $message = 'Resource is update successfully';
            $statusCode = 200;
        } else { // id tidak ditemukan
            $statusPatients = [];
            $message = 'Resource not found';
            $statusCode = 404;
        }

        // membuat response
        $response = [
            'message' => $message,
            'status' => $statusCode,
            'data' => $statusPatients
        ];

        return response()->json($response, $statusCode);
    }

    // delete statusPatients
    public function destroy($id)
    {
        // inisialisasi $statusPatients dengan static method find($id)
        $statusPatients = statusPatient::find($id);
        $message = '';
        $statusCode = 0;

        if ($statusPatients) { // id ditemukan
            $statusPatients->delete();

            $message = 'Resource is delete successfully';
            $statusCode = 200;
        } else { // id tidak ditemukan
            $message = 'Resource not found';
            $statusCode = 404;
        }

        // membuat response
        $response = [
            'message' => $message,
            'status' => $statusCode,
        ];

        return response()->json($response, $statusCode);
    }
}
