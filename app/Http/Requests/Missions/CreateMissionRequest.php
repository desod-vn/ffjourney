<?php

namespace App\Http\Requests\Missions;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateMissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:100',
                'string',
                Rule::unique('missions', 'name')->where(function ($query) {
                    return $query->where('user_id', Auth::user()->id)
                        ->where('mission_type_id', $this->input('mission_type_id'));
                }),
            ],
            'description' => 'sometimes|nullable|string|max:255',
            'mission_type_id' => 'required|integer|exists:mission_type_user,mission_type_id,user_id,'. Auth::user()->id,
            'start_at' => 'sometimes|nullable|date_format:"Y/m/d"|before_or_equal:end_at',
            'end_at' => 'sometimes|nullable|date_format:"Y/m/d"|after_or_equal:start_at',
            'notify_at' => 'sometimes|nullable|date_format:"H:i"',
            'repeat_type' => 'sometimes|nullable|integer|max:10',
            'repeat_config' => 'sometimes|nullable|integer|max:10',
        ];
    }
}
