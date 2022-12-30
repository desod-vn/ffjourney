<?php

namespace App\Actions\MissionActions;

use Exception;
use App\Models\Mission;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CreateMission
{
    public static function execute(array $data) : array
    {
        try {
            $mission = Mission::firstOrCreate(array_merge($data, ['user_id' => Auth::user()->id]));
            return [
                'status' => Response::HTTP_OK,
                'success' => true,
                'data' => [
                    'mission' => $mission,
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