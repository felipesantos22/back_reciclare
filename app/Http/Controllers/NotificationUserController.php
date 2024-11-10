<?php

namespace App\Http\Controllers;

use App\Models\Notification_User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        try {
            $validatedData = $request->validate([
                'id_notification' => 'required|exists:notifications,id',
                'id_user' => 'required|exists:users,id',
                'seen' => 'boolean',
                'date_seen' => 'nullable|date',
            ]);

            $notificationUser = Notification_User::create($validatedData);

            return response()->json($notificationUser, 201);

        } catch (ValidationException $e) {
            $errors = [];

            if ($e->validator->errors()->has('id_notification')) {
                $errors['id_notification'] = 'A notificação especificada não existe.';
            }

            if ($e->validator->errors()->has('id_user')) {
                $errors['id_user'] = 'O usuário especificado não existe.';
            }

            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $errors
            ], 422);
        }
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
