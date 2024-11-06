<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::all();
        return response()->json($notices);
    }

    public function show($id)
    {
        $notice = Notice::find($id);
        if (!$notice) {
            return response()->json(['message' => 'Notice not found'], 404);
        }
        return response()->json($notice);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
        ]);

        $notice = Notice::create($request->all());
        return response()->json($notice, 201);
    }

    public function update(Request $request, $id)
    {
        $notice = Notice::find($id);
        if (!$notice) {
            return response()->json(['message' => 'Notice not found'], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
        ]);

        $notice->update($request->all());
        return response()->json($notice);
    }

    public function destroy($id)
    {
        $notice = Notice::find($id);
        if (!$notice) {
            return response()->json(['message' => 'Notice not found'], 404);
        }

        $notice->delete();
        return response()->json(['message' => 'Notice deleted']);
    }
}
