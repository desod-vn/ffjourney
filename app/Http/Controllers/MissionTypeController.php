<?php

namespace App\Http\Controllers;

use App\Actions\MissionTypeActions\ListMissionType;
use App\Actions\MissionTypeActions\CreateMissionType;
use App\Http\Requests\MissionTypes\CreateMissionTypeRequest;

class MissionTypeController extends Controller
{
    public function index()
    {
        $result = ListMissionType::execute();
        return response()->json($result, $result['status']);
    }

    public function store(CreateMissionTypeRequest $request)
    {
        $result = CreateMissionType::execute($request->only(['name']));
        return response()->json($result, $result['status']);
    }
}
