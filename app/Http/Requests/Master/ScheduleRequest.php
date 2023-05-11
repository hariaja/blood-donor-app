<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
      'registration_id' => 'required',
      'date' => 'required|date_format:Y-m-d',
      'time' => 'required'
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'registration_id.required' => ':attribute tidak boleh dikosongkan',
      'date.required' => ':attribute tidak boleh dikosongkan',
      'date.date' => ':attribute harus berupa tanggal',
      'time.required' => ':attribute tidak boleh dikosongkan',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'registration_id' => 'Pendaftaran',
      'date' => 'Jadwal pengambilan darah',
      'time' => 'Jam pengambilan darah'
    ];
  }
}
