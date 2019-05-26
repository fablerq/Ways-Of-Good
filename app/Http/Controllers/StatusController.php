<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Status;
use App\Models\Ticket;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $statuses = Status::all();

        return response()->json($statuses, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StatusRequest $request)
    {
        $validated = $request->validated();
        Status::create([
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
        $status = Status::find($id);

        return response()->json($status, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        if (Ticket::where('status_id', $id)->first()) {
            return response()->json([
                'message' => 'Статус номер '.$id.' не получилось удалить. Есть связанные тикеты',
            ]);
        }
        Status::destroy($id);

        return response()->json([
            'message' => 'Статус номер '.$id.' удален успешно',
        ]);
    }
}
