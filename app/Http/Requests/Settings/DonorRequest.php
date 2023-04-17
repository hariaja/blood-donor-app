<?php

namespace App\Http\Requests\Settings;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DonorRequest extends FormRequest
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
      'name' => 'required|string|max:50',
      'email' => [
        'required', 'email:dns',
        Rule::unique('users', 'email'),
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        Rule::unique('users', 'phone'),
      ],
      'nik' => [
        'required', 'numeric', 'min:12',
        Rule::unique('donors', 'nik'),
      ],
      'blood_type_id' => 'required|numeric',
      'birth_date' => 'required|date',
      'job_title' => 'required|string|max:30',
      'gender' => 'required|string',
      'address' => 'required|string',
      'avatar' => 'nullable|mimes:jpg,png|max:3048',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'blood_type_id.required' => ':attribute tidak boleh dikosongkan',
      'blood_type_id.numeric' => ':attribute tidak valid',

      'name.required' => ':attribute tidak boleh dikosongkan',
      'name.string' => ':attribute tidak valid, masukkan yang benar',
      'name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'nik.required' => ':attribute tidak boleh dikosongkan',
      'nik.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'nik.numeric' => ':attribute harus berupa angka',
      'nik.min' => ':attribute terlalu pendek, minimal :min karakter',

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :min karakter',

      'gender.string' => ':attribute tidak valid, masukkan yang benar',
      'gender.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'address.required' => ':attribute tidak boleh dikosongkan',
      'address.string' => ':attribute tidak valid, masukkan yang benar',
      'address.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'avatar.image' => ':attribute tidak valid, pastikan memilih gambar',
      'avatar.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'avatar.max' => ':attribute terlalu besar, maksimal :max kb',

      'birth_date.required' => ':attribute tidak boleh dikosongkan',
      'birth_date.date' => ':attribute harus berupa tanggal',

      'job_title.required' => ':attribute tidak boleh dikosongkan',
      'job_title.max' => ':attribute terlalu panjang, maksimal :max karakter',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'blood_type_id' => 'Golongan darah',
      'nik' => 'Nomor Induk Kependudukan',
      'name' => 'Nama lengkap',
      'email' => 'Email',
      'phone' => 'Nomor telepon',
      'gender' => 'Jenis kelamin',
      'address' => 'Alamat lengkap',
      'avatar' => 'Foto profil',
      'birth_date' => 'Tanggal lahir',
      'job_title' => 'Pekerjaan',
    ];
  }
}
