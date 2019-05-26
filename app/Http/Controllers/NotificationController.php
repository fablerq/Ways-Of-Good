<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\Place;

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

    function generateRandomString($n) { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString; 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(NotificationRequest $request)
    {
        $validated = $request->validated();
        //$secretKey = generateRandomString(10);
        $secretKey = "EWOFNOEWNF3209F9023ND";
        //$code = getCode();
        $codenames= array( "добро", "май", "кот", "солнце", "мир", "снег", "фильм", "рука", "река", "цвет", "очки", "носок", "экран", "чек", "цепь", "вода", "яблоко", "ткань", "стол", "куртка", "шапка" );
        $code = $codenames[array_rand($codenames)];
        Notification::create([
            'name' => $validated['name'],
            'sex' => $validated['sex'],
            'code' => $code,
            'secretKey' => $secretKey,
            'isEat' => $validated['isEat'],
            'isSleep' => $validated['isSleep'],
            'isMed' => $validated['isMed'],
            'isHeat' => $validated['isHeat'],
            'isDry' => $validated['isDry'],
            'isWork' => $validated['isWork'],
            'created_at' => $validated['created_at'],
            'aboutTime' => $validated['aboutTime'],
            'endOfTicket' => $validated['endOfTicket']
        ]);

        $tickets = Ticket::where([
            ['isEat', '=', $validated['isEat']],
            ['isEat', '=', true]])
            ->orWhere([
                ['isSleep', '=', $validated['isSleep']],
                ['isSleep', '=', true]])
            ->orWhere([
                ['isMed', '=', $validated['isMed']],
                ['isMed', '=', true]])
            ->orWhere([
                ['isHeat', '=', $validated['isHeat']],
                ['isHeat', '=', true]])
            ->orWhere([
                ['isDry', '=', $validated['isDry']],
                ['isDry', '=', true]])
            ->orWhere([
                ['isWork', '=', $validated['isWork']],
                ['isWork', '=', true]])
            ->get();

        $ticketsPlaceId = $tickets->pluck('place_id');
        $places = Place::whereIn('id', $ticketsPlaceId)->get();    


        return response()->json([$secretKey, $tickets, $places], 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);

        //$tickets = Tickets::where()
        //update
            //'place_id' => $validated['place_id'],
            //data
            //isCame

    }
 

    function getWord() {
        $codenames= array( "добро", "май", "кот", "солнце", "мир", "снег", "фильм", "рука", "река", "цвет", "очки", "носок", "экран", "чек", "цепь", "вода", "яблоко", "ткань", "стол", "куртка", "шапка" );
        return $codenames;
    }

    /**
     * 
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
