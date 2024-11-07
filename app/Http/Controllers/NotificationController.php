<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    public function show($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
        return response()->json($notification);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_notice' => 'required|exists:notices,id',
                'alias' => 'required|string|max:255',
            ], [
                'id_notice.exists' => 'O campo id_notice deve referenciar um id válido na tabela notices.',
            ]);
            $notification = Notification::create($validatedData);

            return response()->json([
                'message' => 'Notificação criada com sucesso',
                'data' => $notification
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Erro ao criar a notificação: chave estrangeira inválida ou erro de banco de dados',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $request->validate([
            'id_notice' => 'required|exists:notices,id',
            'alias' => 'required|string',
        ]);

        $notification->update($request->all());
        return response()->json($notification);
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();
        return response()->json(['message' => 'Notification deleted']);
    }
}
