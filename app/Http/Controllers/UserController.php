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

    
    public function addPlace($userId, $placeId)
    {
        if (User::where('id', $userId)->first() && Place::where('id', $placeId)->first()) {
            DB::insert('insert into place_user (user_id, place_id) values (?, ?)', [$userId, $placeId]);
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

    public function addOrganization($userId, $organizationId)
    {
        if (User::where('id', $userId)->first() && Organization::where('id', $organizationId)->first()) {
            DB::insert('insert into organization_user (organization_id, user_id) values (?, ?)', [$organizationId, $userId]);
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
