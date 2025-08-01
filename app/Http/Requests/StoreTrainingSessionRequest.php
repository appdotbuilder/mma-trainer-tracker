<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingSessionRequest extends FormRequest
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
            'training_block_id' => 'nullable|exists:training_blocks,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scheduled_at' => 'required|date',
            'type' => 'required|in:striking,grappling,conditioning,technique,sparring,mixed',
            'intensity' => 'required|in:low,moderate,high,max',
            'status' => 'in:scheduled,in_progress,completed,cancelled,missed',
            'notes' => 'nullable|string',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Session title is required.',
            'scheduled_at.required' => 'Scheduled date and time is required.',
            'type.required' => 'Session type is required.',
            'intensity.required' => 'Training intensity is required.',
        ];
    }
}