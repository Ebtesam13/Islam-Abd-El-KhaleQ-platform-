<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'senior_year'=>['string','nullable','required_if:user_type,student'],
            'current_stage'=>['string','nullable','required_if:user_type,student'],
            'area_id'=>['integer','nullable','required_if:user_type,student'],
            'city_id'=>['integer','nullable','required_if:user_type,student'],
            'school'=>['string','nullable','required_if:user_type,student'],
            'school_type'=>['string','nullable'],
            'second_language'=>['string','nullable'],
            'mobile'=>['string','nullable','required_if:user_type,student'],
            'parent_mobile'=>['string','nullable','required_if:user_type,parent'],
            'mobile_country_code'=>['string','nullable'],
            'mom_whats_app'=>['string','nullable','required_if:user_type,student'],
            'dad_whats_app'=>['string','nullable','required_if:user_type,student'],
            'dad_job'=>['string','nullable','required_if:user_type,student'],
            'job'=>['string','nullable','required_if:user_type,parent'],
            'facebook_link'=>['string','nullable'],
            'identity_number'=>['string','nullable','required_if:user_type,student'],
            'language'=>['string','nullable'],
            'image_path' => 'nullable|mimes:jpeg,png,jpg,jpeg,gif|max:2048',
        ];
    }
}
