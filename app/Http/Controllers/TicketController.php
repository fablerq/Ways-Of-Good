<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\AdvancedTicket;
use App\Models\Ticket;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tickets = Ticket::all();

        return response()->json($tickets, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }


    public function showForUser($id)
    {
        $tickets = Ticket::where('user_id', $id)->get();

        return response()->json($tickets, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    public function showForOrg($id)
    {
        $tickets = Ticket::where('organization_id', $id)->get();

        return response()->json($tickets, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TicketRequest $request)
    {
        $validated = $request->validated();
        if (empty($validated['organization_id']))
        {
            Ticket::create([
                'user_id' => $validated['user_id'],
                'place_id' => $validated['place_id'],
                'status_id' => $validated['status_id'],
                'isEat' => $validated['isEat'],
                'isSleep' => $validated['isSleep'],
                'isMed' => $validated['isMed'],
                'isHeat' => $validated['isHeat'],
                'isDry' => $validated['isDry'],
                'isWork' => $validated['isWork'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'availableVisitors' => $validated['availableVisitors'],
                'startTime' => $validated['startTime'],
                'endTime' => $validated['endTime']
            ]);
        }
        else {
            $aticket = AdvancedTicket::create([
                'startInterval' => $validated['startInterval'],
                'endInterval' => $validated['endInterval'],
                'isMonday' => $validated['isMonday'],
                'isTuesday' => $validated['isTuesday'],
                'isWednesday' => $validated['isWednesday'],
                'isThursday' => $validated['isThursday'],
                'isFriday' => $validated['isFriday'],
                'isSaturday' => $validated['isSaturday'],
                'isSunday' => $validated['isSunday'],
            ]);
            //Ticket::create($validated->all());
            Ticket::create([
                'organization_id' => $validated['organization_id'],
                'advancedticket_id' => $aticket->id,
                'place_id' => $validated['place_id'],
                'status_id' => $validated['status_id'],
                'isEat' => $validated['isEat'],
                'isSleep' => $validated['isSleep'],
                'isMed' => $validated['isMed'],
                'isHeat' => $validated['isHeat'],
                'isDry' => $validated['isDry'],
                'isWork' => $validated['isWork'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'availableVisitors' => $validated['availableVisitors'],
                'startTime' => $validated['startTime'],
                'endTime' => $validated['endTime']
            ]);
        }

        return response()->json([
            'message' => 'Успешно добавлено',
        ]);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::where('id', $id)->update($request->all())->get();
        return response()->json($ticket, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        $ticket = Ticket::find($id);
        $tags = DB::table('tag_ticket')->where('ticket_id', $id)->get();
        return response()->json([$ticket, $tags], 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    public function startTicket($id)
    {
        $ticket = Ticket::where('id', $id);
        if($ticket)
        {
            $ticket->update(['status_id' => '1']);
            return response()->json([
                'message' => 'Успешно начат',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error. Нет такого тикета',
            ]);
        }
    }

    public function stopTicket($id)
    {
        $ticket = Ticket::where('id', $id);
        if($ticket)
        {
            $ticket->update(['status_id' => '2']);
            return response()->json([
                'message' => 'Успешно остановлено',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error. Нет такого тикета',
            ]);
        }
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
        Ticket::destroy($id);

        return response()->json([
            'message' => 'Тикет номер '.$id.' удален успешно',
        ]);
    }

    public function addTag($ticketId, $tagId)
    {
        if (Tag::where('id', $tagId)->first() && Ticket::where('id', $ticketId)->first()) {
            DB::insert('insert into tag_ticket (tag_id, ticket_id) values (?, ?)', [$tagId, $ticketId]);
            return response()->json([
                'message' => 'Success.',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error.',
            ]);
        }
    }
}
