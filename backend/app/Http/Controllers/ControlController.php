<?php

namespace App\Http\Controllers;

use App\Models\Control;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControlController extends Controller
{
    public function index()
    {
        $controls = Control::all();
        return response()->json([
            'status' => 200,
            'controls' => $controls
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'open_close' => 'required|in:on,off',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $control = Control::create([
            'open_close' => $request->input('open_close'),
            'logout_time' => now() // Set logout_time to the current timestamp
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Control Created Successfully',
            'control' => $control
        ], 200);
    }

    public function show($id)
    {
        $control = Control::find($id);

        if ($control) {
            return response()->json([
                'status' => 200,
                'control' => $control
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Control Not Found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'open_close' => 'required|in:on,off',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $control = Control::find($id);

        if ($control) {
            $control->update([
                'open_close' => $request->input('open_close'),
                'logout_time' => now() // Update logout_time to the current timestamp
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Control Updated Successfully',
                'control' => $control
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Control Not Found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $control = Control::find($id);

        if ($control) {
            $control->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Control Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Control Not Found'
            ], 404);
        }
    }
}
