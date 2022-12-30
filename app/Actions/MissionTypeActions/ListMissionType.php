<?php

namespace App\Actions\MissionTypeActions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ListMissionType
{
    public static function execute() : array
    {
        try {
            $mission_type = User::find(Auth::user()->id)->missionTypes;
            return [
                'status' => Response::HTTP_OK,
                'success' => true,
                'data' => [
                    'mission_type' => $mission_type,
                    'message' => 'Success'
                ] 
            ];
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}