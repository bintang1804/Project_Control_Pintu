<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotifController extends Controller
{
    public function index()
    {
        $notifs = Notif::all();
        return response()->json([
            'status' => 200,
            'notifs' => $notifs
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notif' => 'required|in:berhasil,gagal,netral',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $notif = Notif::create([
            'notif' => $request->input('notif'),
            'login_time' => now() // Set logout_time to the current timestamp
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'notif Created Successfully',
            'control' => $notif
        ], 200);
    }

    public function show($id)
    {
        $notif = Notif::find($id);

        if ($notif) {
            return response()->json([
                'status' => 200,
                'notif' => $notif
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Notification Not Found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'notif' => 'required|in:berhasil,gagal,netral',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $notif = Notif::find($id);

        if ($notif) {
            $notif->update([
                'notif' => $request->input('notif'),
                'login_time' => now()
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Notification Updated Successfully',
                'notif' => $notif
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Notification Not Found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $notif = Notif::find($id);

        if ($notif) {
            $notif->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Notification Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Notification Not Found'
            ], 404);
        }
    }
}
