<?php

namespace App\Actions\MissionActions;

use Exception;
use App\Models\Mission;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class ListMission
{
    public static function execute(array $filters) : array
    {
        try {
            $mission = User::find(Auth::user()->id)->missions();
            if (!empty($filters['name'])) {
                $mission->where('name', 'like', '%' . $filters['name'] . '%');
            }
            if (!empty($filters['mission_type_id'])) {
                $mission->where('mission_type_id', $filters['mission_type_id']);
            }
            if (!empty($filters['mark'])) {
                $mission->where('mark', $filters['mark']);
            }
            if (!empty($filters['repeat_type'])) {
                $mission->where('repeat_type', $filters['repeat_type']);
            }
            if (!empty($filters['start_at'])) {
                $mission->whereDate('start_at', $filters['start_at']);
            }
            if (!empty($filters['end_at'])) {
                $mission->whereDate('end_at', $filters['end_at']);
            }
            if (!empty($filters['unmark'])) {
                $mission->whereDate('end_at', '<', Carbon::now())->whereNull('mark');
            }
            $mission = $mission->get();
            return [
                'status' => Response::HTTP_OK,
                'success' => true,
                'data' => [
                    'mission_type' => $mission,
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