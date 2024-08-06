<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $paginate = $request->input('paginate', 10); // Valor predeterminado es 10

        $challenges = Challenge::paginate($paginate);

        return response()->json($challenges);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return response()->json(Challenge::findOrFail($id));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'difficulty' => 'required|integer|between:1,5',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $challenge = Challenge::create($request->only(['title', 'description', 'difficulty', 'user_id']));
        return response()->json($challenge, 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'difficulty' => 'required|integer|between:1,5',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $challenge = Challenge::findOrFail($id);
        $challenge->update($request->all());
        return response()->json($challenge);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        Challenge::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
