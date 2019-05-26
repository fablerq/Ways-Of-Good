<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Type;
use App\Models\Ticket;

class TypeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $types = Type::all();

        return response()->json($types, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TypeRequest $request)
    {
        $validated = $request->validated();
        Type::create([
            'title' => $validated['title']
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
        $type = Type::find($id);

        return response()->json($type, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        if (Ticket::where('type_id', $id)->first()) {
            return response()->json([
                'message' => 'Тип номер '.$id.' не получилось удалить. Есть связанные тикеты',
            ]);
        }
        Type::destroy($id);

        return response()->json([
            'message' => 'Тип номер '.$id.' удалено успешно',
        ]);
    }
}
