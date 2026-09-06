<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Book::class) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return self::bookRules();
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function bookRules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'author' => ['required', 'string', 'min:2', 'max:255'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'isbn' => ['nullable', 'string', 'max:255', Rule::unique('books', 'isbn')],
            'published_at' => ['nullable', 'date'],
            'is_popular' => ['sometimes', 'boolean'],
            'is_bestseller' => ['sometimes', 'boolean'],
        ];
    }
}
