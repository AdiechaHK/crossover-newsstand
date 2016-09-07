<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Auth;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::user() != null);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => "required",
            'image' => "required|image",
            'text'  => "required"
        ];
    }

    public function save_image() {
        if ($this->file('image')->isValid()) {
            $extension = $this->image->extension();
            $image = $this->file('image');
            $name = time() . "." . $extension;
            $path = 'user_upload';
            $image->move(public_path($path), $name);
            return $path . "/" . $name;
        } else {
            return null;
        }
    }
}
