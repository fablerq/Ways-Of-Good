<?php

namespace App\Http\Controllers;

use App\Http\Requests\IconRequest;
use App\Models\Ticket;
use App\Models\Icon;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $icons = Icon::all();

        return response()->json($icons, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(IconRequest $request)
    {
        $validated = $request->validated();
        Icon::create([
            'url' => $validated['url'],
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
        $icon = Icon::find($id);

        return response()->json($icon, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        if (Ticket::where('icon_id', $id)->first()) {
            return response()->json([
                'message' => 'Иконку номер '.$id.' не получилось удалить. Что-то с ним связано',
            ]);
        }
        Icon::destroy($id);

        return response()->json([
            'message' => 'Иконка номер '.$id.' удалена успешно',
        ]);
    }
}
