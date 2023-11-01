<?php

namespace App\Models;

use App\InvolvedCourse;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Nilaimbkm extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'reg_mbkms';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */


    public function input_nilai($crud = false)
    {
        return '<a class="btn btn-sm btn-link" href="/admin/nilaimbkm/' . $this->id . '/inputnilai" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Input Nilai</a>';
    }
    public function download_nilai($crud = false)
    {
        return '<a class="btn btn-sm btn-link" href="/admin/download/' . $this->nilai_mitra . '" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Nilai Mitra</a>';
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function lecturers()
    {
        return $this->belongsTo(Lecturer::class, 'pembimbing', 'id');
    }

    public function mbkm()
    {
        return $this->belongsTo(Mbkm::class, 'mbkm_id', 'id');
    }

    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }

    public function involved(){
        return $this->hasMany(InvolvedCourse::class, 'reg_mbkm_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
