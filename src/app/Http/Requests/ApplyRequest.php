<?php

namespace App\Http\Requests;

use App\Models\Position;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'position_id' => [
                'required',
                'exists:positions,id',
                function($attribute, $value, $fail) {

                    $position = Position::find($value);

                    if(!$position) return;

                    if(is_null($position->opened_at)) {
                        $fail('This position is not open for application.');
                    }

                    if(!is_null($position->closed_at)) {
                        $fail('This position is closed.');
                    }
                },
                Rule::unique('applications')
                    ->where('user_id', $this->user()->id)
                    ->where('position_id', $this->input('position_id'))
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'position_id.unique' => 'You have already applied for this position.'
        ];
    }
}
