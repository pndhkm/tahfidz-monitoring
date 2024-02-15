<?php

namespace App\Model\SiswaHasParent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiswaHasParent extends Model
{
    // use Filterable;

    protected $table = 'tbl_siswa_has_parent';
    protected $guard_name = 'web';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 
        'siswa_id',
        'siswa_name', 
        'class_id',
        'class_name',
        'angkatan',
        'note',
        'teacher_id',
        'teacher_name' 
    ];

    public static $rules = [
        'parent_id' => 'required | integer',
        'siswa_id' => 'required | integer',
        'siswa_name' => 'string',
        'class_id' => 'required | integer',
        'class_name' => 'string',
        'angkatan' => 'string',
        'note' => 'string',
        'teacher_id' => 'required | integer',
        'teacher_name' => 'string',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * 
     */
    public static function validateSiswaParent($parent_id, $siswa_id)
    {
        $data = self::where('parent_id',$parent_id)->where('siswa_id',$siswa_id)->first();

        if($data != null)
        {
            return true;
        }

        return false;
    }

    public static function getByParent($parent_id)
    {
        return self::where('parent_id',$parent_id)->get();
    }


    /**
     * 
     */
    public function getParent()
    {
        return $this->hasOne('App\Model\User\User','id','parent_id');
    }

    /**
     * 
     */
    public function getSiswa()
    {
        return $this->belongsTo('App\Model\Siswa\Siswa');
    }
}