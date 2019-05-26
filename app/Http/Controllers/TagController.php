<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = Tag::all();

        return response()->json($tags, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TagRequest $request)
    {
        $validated = $request->validated();
        Tag::create([
            'title' => $validated['title'],
        ]);

        return response()->json([
            'message' => 'Успешно добавлено',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return response()->json($tag, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Tag::destroy($id);

        return response()->json([
            'message' => 'Тэг номер '.$id.' удален успешно',
        ]);
    }
}
