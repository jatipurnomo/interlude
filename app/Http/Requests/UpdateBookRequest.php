<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('book')) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'author' => ['required', 'string', 'min:2', 'max:255'],
            'cover_image' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'isbn' => ['nullable', 'string', 'max:255', Rule::unique('books', 'isbn')->ignore($this->route('book'))],
            'published_at' => ['nullable', 'date'],
            'is_new' => ['sometimes', 'boolean'],
            'is_popular' => ['sometimes', 'boolean'],
            'is_bestseller' => ['sometimes', 'boolean'],
        ];
    }
}
