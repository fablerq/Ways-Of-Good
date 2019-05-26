<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use App\Models\Ticket;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $organizations = Organization::all();

        return response()->json($organizations, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(OrganizationRequest $request)
    {
        $validated = $request->validated();
        Organization::create([
            'title' => $validated['title'],
            'about' => $validated['about'],
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
        $organization = Organization::find($id);

        return response()->json($organization, 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
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
        Organization::destroy($id);

        return response()->json([
            'message' => 'Организация номер '.$id.' удалена успешно',
        ]);
    }
}
