<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\User;
use App\Models\Ticket;
use App\Models\Place;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserID(){
        return response()->json(Auth::id());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo()
    {
        return response()->json(Auth::user());
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'image' => $validated['image'],
            'points' => $validated['points']
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
        $user = User::find($id);
        $places = DB::table('place_user')->where('user_id', $id)->get();
        $orgs = DB::table('organization_user')->where('user_id', $id)->get();
        return response()->json([$user, $places, $orgs], 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        if (Ticket::where('user_id', $id)->first()) {
            return response()->json([
                'message' => 'Юзер номер '.$id.' не получилось удалить. Есть связанные тикеты',
            ]);
        }
        User::destroy($id);

        return response()->json([
            'message' => 'Юзер номер '.$id.' удалено успешно',
        ]);
    }
}