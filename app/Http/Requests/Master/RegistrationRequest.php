<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'last_donor' => 'nullable|date_format:Y-m-d',
      'urgency' => 'required|min:1',
      'ramadan' => 'required|min:1',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'last_donor.required' => ':attribute tidak boleh dikosongkan',
      'last_donor.date' => ':attribute harus berupa tanggal',
      'urgency.required' => ':attribute tidak boleh dikosongkan',
      'urgency.min' => 'Mohon pilih salah satu :attribute',
      'ramadan.required' => ':attribute tidak boleh dikosongkan',
      'ramadan.min' => 'Mohon pilih salah satu :attribute',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'last_donor' => 'Terakhir Donor',
      'urgency' => 'Kebutuhan Mendadak',
      'ramadan' => 'Donor Bulan Puasa',
    ];
  }
}
