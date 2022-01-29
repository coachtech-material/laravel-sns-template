<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'content' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png']
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '内容を入力してください',
            'content.string' => '内容を文字列で入力してください',
            'content.max' => '内容を255文字以下で入力してください',
            'image.required' => '画像ファイルをアップロードしてください',
            'image.file' => 'ファイルをアップロードしてください',
            'image.image' => '画像ファイルをアップロードしてください',
            'image.mimes' => 'jpgまたはjpegまたはpng形式のファイルをアップロードしてください'
        ];
    }
}
