<?php

namespace App\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

use App\Model\Siswa\Siswa;

class AssessmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        $memorization_type = Siswa::findOrFail($this->request->get('id_siswa'))->memorization_type;
    
        if($memorization_type != Siswa::TYPE_IQRO)
        {
            return [
                'id_siswa'          => 'integer',
                'surah_id'          => 'integer',
                'ayat'              => 'integer',
                'kelancaran'        => 'string | nullable',
                'tajwid'            => 'string | nullable',
                'makhraj'           => 'string | nullable',
                'nilai'             => 'string | nullable',
                'banyak_halaman'    => 'string | nullable',
                'note'              => 'string | nullable',
                'begin'             => 'integer',
                'end'               => 'integer',
                'nis'               => 'string | nullable', 
            ];
        }
        else
        {
            return [
                'id_siswa'      => 'integer',
                'iqro_id'       => 'integer',
                'page'          => 'integer',
                'note'          => 'string | nullable',
                'begin'         => 'integer',
                'end'           => 'integer',
                'nis'           => 'string | nullable', 
            ];
        }
    }
    
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            
        ];
    }
}
