<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $paginate = $request->input('paginate', 10); // Valor predeterminado es 10

        $videos = Video::paginate($paginate);

        return response()->json($videos);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return response()->json(Video::findOrFail($id));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'videoable_type' => 'required|string',
            'videoable_id' => 'required|integer'
        ]);

        $video = Video::create([
            'url' => $request->input('url'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id'),
            'videoable_type' => $request->input('videoable_type'),
            'videoable_id' => $request->input('videoable_id'),
        ]);


        return response()->json($video, 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'videoable_type' => 'required|string',
            'videoable_id' => 'required|integer'
        ]);

        $video = Video::findOrFail($id);
        $video->update($request->all());
        return response()->json($video);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
