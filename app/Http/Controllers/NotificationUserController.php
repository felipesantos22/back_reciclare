<?php

namespace App\Http\Controllers;

use App\Models\Notification_User;
use Illuminate\Http\Request;

class NotificationUserController extends Controller
{
    public function index()
    {
        $notificationUsers = Notification_User::all();
        return response()->json($notificationUsers);
    }

    public function show($id)
    {
        $notificationUser = Notification_User::find($id);
        if (!$notificationUser) {
            return response()->json(['message' => 'Notification User not found'], 404);
        }
        return response()->json($notificationUser);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_notification' => 'required|exists:notifications,id',
            'id_user' => 'required|exists:users,id',
            'seen' => 'boolean',
            'date_seen' => 'nullable|date',
        ]);

        $notificationUser = Notification_User::create($request->all());
        return response()->json($notificationUser, 201);
    }

    public function update(Request $request, $id)
    {
        $notificationUser = Notification_User::find($id);
        if (!$notificationUser) {
            return response()->json(['message' => 'Notification User not found'], 404);
        }

        $request->validate([
            'id_notification' => 'required|exists:notifications,id',
            'id_user' => 'required|exists:users,id',
            'seen' => 'boolean',
            'date_seen' => 'nullable|date',
        ]);

        $notificationUser->update($request->all());
        return response()->json($notificationUser);
    }

    public function destroy($id)
    {
        $notificationUser = Notification_User::find($id);
        if (!$notificationUser) {
            return response()->json(['message' => 'Notification User not found'], 404);
        }

        $notificationUser->delete();
        return response()->json(['message' => 'Notification User deleted']);
    }
}
