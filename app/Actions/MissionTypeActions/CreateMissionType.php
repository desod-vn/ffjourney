<?php

namespace App\Actions\MissionTypeActions;

use Exception;
use App\Models\MissionType;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CreateMissionType
{
    public static function execute(array $data) : array
    {
        try {
            $mission_type = MissionType::firstOrCreate($data);
            $user = User::find(Auth::user()->id);
            $latestOrder = $user->missionTypes()->count();
            $user->missionTypes()->syncWithoutDetaching([
                $mission_type->id => ['order' => $latestOrder]
            ]);
            return [
                'status' => Response::HTTP_OK,
                'success' => true,
                'data' => [
                    'mission_type' => $mission_type,
                    'message' => 'Success',
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