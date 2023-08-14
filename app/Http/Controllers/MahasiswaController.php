<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return $this->responseAPI(200, 'success', $data);
    }

    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'umur' => 'required',
            'alamat' => 'required'
        ]);

        $data = new Mahasiswa();
        $data->nama = $validateData['nama'];
        $data->umur = $validateData['umur'];
        $data->alamat = $validateData['alamat'];
        $data->save();

        return $this->responseAPI(201, 'data inserted', $data);
    }

    
    public function show($id)
    {
        $data = Mahasiswa::find($id);

        if (!$data) {
            return $this->responseAPI(404, 'data not found', null);
        }

        return $this->responseAPI(200, 'success', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'umur' => 'required',
            'alamat' => 'required'
        ]);

        $data = Mahasiswa::find($id);

        if (!$data) {
            return $this->responseAPI(404, 'data not found', null);
        }

        $data->nama = $validateData['nama'];
        $data->umur = $validateData['umur'];
        $data->alamat = $validateData['alamat'];
        $data->save();

        return $this->responseAPI(200, 'data updated', $data);
    }

    public function destroy($id)
    {
        $data = Mahasiswa::find($id);

        if (!$data) {
            return $this->responseAPI(404, 'data not found', null);
        }

        $data->delete();
        return $this->responseAPI(202, 'data deleted', null);
    }

    public function responseAPI($statusCode, $message, $data)
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
            'data' => $data
        ]);
    }
}
