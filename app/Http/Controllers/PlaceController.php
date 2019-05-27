<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use App\Models\Ticket;
use App\Models\Notification;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $places = Place::all();

        return response()->json($places, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PlaceRequest $request)
    {
        $validated = $request->validated();
        Place::create([
            'users_id' => $validated['user_id'],
            'icon_id' => $validated['icon_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'geoData' => $validated['geoData'],
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
        $place = Place::find($id);

        return response()->json($place, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }


    public function update(Request $request, $id)
    {
        $place = Place::where('id', $id)->update($request->all())->get();
        return response()->json($place, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        if (Ticket::where('place_id', $id)->first()) {
            return response()->json([
                'message' => 'Место номер '.$id.' не получилось удалить. Есть связанные тикеты',
            ]);
        }
        Place::destroy($id);

        return response()->json([
            'message' => 'Место номер '.$id.' удалено успешно',
        ]);
    }
}
