<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvancedTicketRequest;
use App\Models\AdvancedTicket;
use App\Models\Ticket;

class AdvancedTicketController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $advancedtickets = AdvancedTicket::all();

        return response()->json($advancedtickets, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(AdvancedTicketRequest $request)
    {
        $validated = $request->validated();
        AdvancedTicket::create([
            'startInterval' => $validated['startInterval'],
            'endInterval' => $validated['endInterval'],
            'isMonday' => $validated['isMonday'],
            'isTuesday' => $validated['isTuesday'],
            'isWednesday' => $validated['isWednesday'],
            'isThursday' => $validated['isThursday'],
            'isFriday' => $validated['isFriday'],
            'isSaturday' => $validated['isSaturday'],
            'isSunday' => $validated['isSunday'],
            'startTime' => $validated['startTime'],
            'endTime' => $validated['endTime'],
        ]);

        return response()->json([
            'message' => 'Успешно добавлено',
        ]);
    }


    public function update(Request $request, $id)
    {
        $aticket = AdvancedTicket::where('id', $id)->update($request->all())->get();
        return response()->json($aticket, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        $advancedticket = AdvancedTicket::find($id);

        return response()->json($advancedticket, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        if (Ticket::where('organization_id', $id)->first()) {
            return response()->json([
                'message' => 'Организацию номер '.$id.' не получилось удалить. Есть связанные тикеты',
            ]);
        }

        AdvancedTicket::destroy($id);

        return response()->json([
            'message' => 'Дополнительные настройки номер '.$id.' удалены успешно',
        ]);
    }
}
