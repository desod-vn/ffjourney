<?php

namespace App\Actions\UserActions;

use App\Models\User;
use App\Models\MissionType;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public static function execute(array $data) : array
    {
        try {
            $user = User::create(array_merge(
                $data,
                ['password' => Hash::make($data['password'])]
            ));
            self::attachMissionType($user);
            return [
                'status' => Response::HTTP_OK,
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => $user->createToken('token')->plainTextToken,
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

    public static function attachMissionType(User $user, array $listId = [])
    {
        if (empty($listId)) {
            $listId = MissionType::where('is_default', true)->pluck('id');
        }
        $data = [];
        foreach ($listId as $index => $id) {
            $data[$id] = ['order' => $index]; 
        }
        $user->missionTypes()->attach($data);
    }
}