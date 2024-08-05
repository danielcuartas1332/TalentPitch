<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->input('paginate', 10); // Valor predeterminado es 10

        $challenges = Challenge::paginate($paginate);

        return response()->json($challenges);
    }

    public function show($id)
    {
        return response()->json(Challenge::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $challenge = Challenge::create($request->all());
        return response()->json($challenge, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $id,
        ]);

        $challenge = Challenge::findOrFail($id);
        $challenge->update($request->all());
        return response()->json($challenge);
    }

    public function destroy($id)
    {
        Challenge::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
