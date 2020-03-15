<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUsers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'name' => 'required|string',
            'profile_photo/*' => 'nullable|image',
            'self_produce' => 'nullable|string',
            'birth_year' => 'required|numeric',
            'birth_month' => 'required|numeric',
            'birth_day' => 'required|numeric'
        ];
    }
}
