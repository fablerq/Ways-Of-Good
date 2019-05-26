<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
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

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TicketRequest $request)
    {
        $validated = $request->validated();
        Ticket::create([
            'user_id' => $validated['user_id'],
            'organization_id' => $validated['organization_id'],
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
            'time' => $validated['time'],
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
        $ticket = Ticket::find($id);
        $tags = DB::table('tag_ticket')->where('ticket_id', $id)->get();
        return response()->json([$ticket, $tags], 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
