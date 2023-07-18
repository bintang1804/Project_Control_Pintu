<?php

namespace App\Http\Controllers;

use App\Models\Iot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IotController extends Controller
{
    public function index()
    {
        $iotDevices = Iot::all();
        return response()->json([
            'status' => 200,
            'iotDevices' => $iotDevices
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card' => 'required|string',
            'nama' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $iotDevice = Iot::create([
            'card' => $request->input('card'),
            'nama' => $request->input('nama'),
            'login_time' => now() // Set login_time to the current timestamp
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Iot Device Created Successfully',
            'iotDevice' => $iotDevice
        ], 200);
    }

    public function show($id)
    {
        $iotDevice = Iot::find($id);

        if ($iotDevice) {
            return response()->json([
                'status' => 200,
                'iotDevice' => $iotDevice
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Iot Device Not Found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'card' => 'required|string',
            'nama' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $iotDevice = Iot::find($id);

        if ($iotDevice) {
            $iotDevice->update([
                'card' => $request->input('card'),
                'nama' => $request->input('nama'),
                'login_time' => now() // Update login_time to the current timestamp
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Iot Device Updated Successfully',
                'iotDevice' => $iotDevice
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Iot Device Not Found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $iotDevice = Iot::find($id);

        if ($iotDevice) {
            $iotDevice->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Iot Device Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Iot Device Not Found'
            ], 404);
        }
    }
}
