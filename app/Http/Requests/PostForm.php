<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsMediaImage;
use Illuminate\Validation\Rule;

class PostForm extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'subcategory_id' => Rule::exists('categories', 'id')->where(function ($query) {
                $query->where('parent_id', $this->get('category_id'));
            }),
            'image' => ['required', new IsMediaImage],
        ];
    }
}
