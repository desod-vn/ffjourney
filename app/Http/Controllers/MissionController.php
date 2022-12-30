<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\MissionActions\CreateMission;
use App\Actions\MissionActions\ListMission;
use App\Http\Requests\Missions\CreateMissionRequest;

class MissionController extends Controller
{
    public function index(Request $request)
    {
        $result = ListMission::execute($request->all());
        return response()->json($result, $result['status']);
    }

    public function store(CreateMissionRequest $request)
    {
        $result = CreateMission::execute($request->all());
        return response()->json($result, $result['status']);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
