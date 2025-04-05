<?php

namespace Modules\Car\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarBasicRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            $rules = [
                'brand_id' => 'required|exists:brands,id',
                'title' => 'required',
                'slug' => 'required|unique:cars',
                'description' => 'required',
                'condition' => 'required|in:used,new',
                'purpose' => 'required|in:Rent,Sale',
                'regular_price' => 'required|numeric',
                'offer_price' => $this->request->get('offer_price') ? 'numeric' : '',
                'custom_id' => 'required|unique:cars,custom_id',
                'plate_number' => 'required|unique:cars,plate_number',
            ];
        }

        if ($this->isMethod('put')) {
            if ($this->request->get('lang_code') == admin_lang()) {
                $rules = [
                    'brand_id' => 'required|exists:brands,id',
                    'title' => 'required',
                    'translate_id' => 'required|exists:car_translations,id',
                    'description' => 'required',
                    'condition' => 'required|in:used,new',
                    'regular_price' => 'required|numeric',
                    'offer_price' => $this->request->get('offer_price') ? 'numeric' : '',
                    'custom_id' => 'required|unique:cars,custom_id,' . $this->car,
                    'plate_number' => 'required|unique:cars,plate_number,' . $this->car,
                ];
            } else {
                $rules = [
                    'title' => 'required',
                    'description' => 'required',
                ];
            }
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'brand_id.required' => trans('translate.Brand is required'),
            'title.required' => trans('translate.Title is required'),
            'slug.required' => trans('translate.Slug is required'),
            'slug.unique' => trans('translate.Slug already exist'),
            'description.required' => trans('translate.Description is required'),
            'condition.required' => trans('translate.Condition is required'),
            'regular_price.required' => trans('translate.Regular price is required'),
            'regular_price.numeric' => trans('translate.Regular price should be numeric'),
            'offer_price.numeric' => trans('translate.Offer price should be numeric'),
            'custom_id.required' => trans('translate.Custom ID is required'),
            'custom_id.unique' => trans('translate.Custom ID must be unique'),
            'plate_number.required' => trans('translate.Plate number is required'),
            'plate_number.unique' => trans('translate.Plate number must be unique'),
        ];
    }
}
