<?php

namespace App\Model\Siswa;

use Auth;

use App\Model\User\User;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Siswa extends Model
{
    protected $table = 'tbl_siswa';
    protected $guard_name = 'web';
 
    const TYPE_IQRO = 10;
    const TYPE_QURAN = 20;
       
    
    protected $fillable = [
        'siswa_name', 
        'class_id', 
        'memorization_type'
    ];

    public static $rules = [
        'siswa_name' => 'required',
        'class_id' => 'required | integer',
        'memorization_type' => 'required | integer'
    ];

    
    protected $hidden = [];

    /**
     * 
     */
    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($siswa) {
            $latestNis = static::max('nis'); 
            $lastAuto = ($latestNis) ? intval(substr($latestNis, -3)) : 0; 
            
            $auto = $lastAuto + 1; 
            $siswa->nis = date('Ymd') . str_pad($auto, 3, '0', STR_PAD_LEFT); 
        });
    }

    /**
     * 
     */
    public function getClass()
    {
        return $this->hasOne('App\Model\StudentClass\StudentClass','id','class_id');
    }

    /**
     * 
     */
    public function getAssessment()
    {
        return $this->belongsTo('App\Model\AssementLog\AssementLog');
    }

    

    public static function getAll($search=null)
    {
        $user = Auth::user();

        if($user->account_type == User::ACCOUNT_TYPE_TEACHER)
        {
            return self::where('siswa_name', 'like', '%'.$search.'%')->join('tbl_class', 'tbl_siswa.class_id', '=', 'tbl_class.id')->select('tbl_siswa.id', 'tbl_siswa.siswa_name','tbl_siswa.memorization_type','tbl_siswa.class_id')->where('teacher_id',$user->id)->get();
        }
        else
        {
            return self::where('siswa_name', 'like', '%'.$search.'%')->get();
        }
    }

    /**
     * 
     */
    public static function getHafalanMeaning($memorization_type)
    {
        switch ($memorization_type) {
            case Siswa::TYPE_IQRO:
                return 'Iqro';
            case Siswa::TYPE_QURAN:
                return 'Al Quran';
            default:
                return '';
        }
    }

}