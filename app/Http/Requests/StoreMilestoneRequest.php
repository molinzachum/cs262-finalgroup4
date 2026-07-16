<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMilestoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 1. Set to true so authenticated team members can create milestones!
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
            // Title is mandatory, must be text, and cannot exceed database varchar limits
            'title' => 'required|string|max:255',
            
            // Description is optional text
            'description' => 'nullable|string',
            
            // Status is optional, but if provided, must strictly match one of these three values
            'status' => 'sometimes|string|in:Pending,In Progress,Completed',
            
            // Dates are optional, but due_date cannot be chronologically before start_date!
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
}