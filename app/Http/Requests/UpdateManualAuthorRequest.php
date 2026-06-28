<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManualAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|max:2048',
            'image_url'   => 'nullable|url|max:500',
            'position'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ];
    }
}
