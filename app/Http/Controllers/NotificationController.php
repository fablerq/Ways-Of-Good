<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;


class NotificationController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $notifications = Notification::all();

        return response()->json($notifications, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(NotificationRequest $request)
    {
        $validated = $request->validated();
        Notification::create([
            'place_id' => $validated['place_id'],
            'name' => $validated['name'],
            'age' => $validated['age'],
            'code' => $validated['code'],
            'isCame' => $validated['isCame'],
            'adress' => $validated['adress'],
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
        $notification = Notification::find($id);

        return response()->json($notification, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        Notification::destroy($id);

        return response()->json([
            'message' => 'Сообщение номер '.$id.' удалено успешно',
        ]);
    }
}
