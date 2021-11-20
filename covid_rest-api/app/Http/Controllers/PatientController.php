<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(){
        $patient = Patient::all();
        if($patient->isNotEmpty()){
            $data =
            [
                'message' => "Menampilkan semua data Pasien",
                'data' => $patient

            ];
            return response()->json($data, 200);
        }else{
            $data =
            [
                'message' => "Data is empty",
                'data' => $patient

            ];
            return response()->json($data, 200);
        }
    }

    public function store(Request $request){

        $validationData =
        $request->validate([
            "nama_pasien"  => 'required',
            "nomor_hp"   => 'required|numeric',
            "alamat" => 'required',
            "statusPatient_id" => 'required | max:1',
            "tanggal_masuk" => 'required | date',
            "tanggal_keluar" => 'nullable | date'
        ],
        [
            'nama_pasien.required' => 'Harus Diisi!', //2016-10-01

            'nomor_hp.required' => 'Harus Diisi!',
            'nomor_hp.numeric' => 'Harus diisi angka',

            'alamat.required' => 'Harus Diisi!',
            'statusPatient_id.required' => 'Harus Diisi!',

            'tanggal_masuk.required' => 'Harus Diisi!',
            'tanggal_masuk.date' => "masukkan tanggal yang benar, contoh: '2016-10-01'"
        ]);

        $patient = Patient::create($validationData);

        $data = [
            'message' => "data is added successfully",
            'data'=>$patient
        ];

        return response()->json($data, 201);
    }

    public function show($id){
        $patient = Patient::find($id);
       
        if ($patient){
            $data = [
                'nama_pasien' => $patient->nama_pasien,
                'nomor_hp' => $patient->nomor_hp,
                'alamat' => $patient->alamat,
                "statusPatient_id" => $patient->status->status,
                'tanggal_masuk' => $patient->tanggal_masuk,
                'tanggal_keluar' => $patient->tanggal_keluar
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
        $patient = Patient::find($id);
        if($patient){
            $input = [
                'nama_pasien'=>$request->nama_pasien ??  $patient->nama_pasien,
                'nomor_hp'=>$request->nomor_hp ?? $patient->nomor_hp, //jika data request dari nomor_hpnya ada maka ambil, klo gk ada requestnya maka pake yg nomor_hp awal (dari patient)
                'statusPatient_id'=>$request->statusPatient_id ??  $patient->statusPatient_id,
                'alamat'=>$request->alamat ??  $patient->alamat,
                'tanggal_keluar'=>$request->tanggal_keluar ?? $patient->tanggal_keluar

            ];

            $patient->update($input);

            $data = [
                'message' => 'data is updated',
                'data'=>$patient
            ];

            return response()->json($data,200);
        }
        else{
            $data = [
                'message' => 'data patient is not found'
            ];
            return response()->json($data, 404);
        }
    }

    public function destroy($id){
        $patient = Patient::find($id);
        if ($patient){
            $patient->delete();

            $data = [
                'message' => 'data is deleted successfully'
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

    public function search($name){
        $patient = Patient::where('nama_pasien', 'Like', '%' . $name . '%')->get();
        if($patient){
        $data = [
            'message' => 'data ditemukan: ',
            'data'=>$patient
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

    public function getStatus($status)
    {
        // inisialisasi $patient dengan static method where statusPatient_id = 1
        $patient = Patient::where('statusPatient_id', '=', 1)->get();
        $message = '';
        $statusCode = 0;

        // mencari status pasien dengan if
        if ($status == 'positive') {
            $patient = $patient;
            $message = 'Get positive resource';
            $statusCode = 200;
        } else if ($status == 'recovered') {
            $patient = Patient::where('statusPatient_id', '=', 2)->get();
            $message = 'Get recovered resource';
            $statusCode = 200;
        } else if ($status == 'dead') {
            $patient = Patient::where('statusPatient_id', '=', 3)->get();
            $message = 'Get dead resource';
            $statusCode = 200;
        } else {
            $patient = [];
            $message = "Resource not found";
            $statusCode = 404;
        }

        // membuat response
        $response = [
            "message" => $message,
            "status code" => $statusCode,
            "total" => count($patient),
            "data" => $patient
        ];

        return response()->json($response, $statusCode);
    }
}
