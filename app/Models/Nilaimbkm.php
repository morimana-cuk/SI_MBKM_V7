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
        return '<a class="btn btn-sm btn-link" href="/admin/nilaimbkm/' . $this->id . '/inputnilai" data-toggle="tooltip" title="Input Nilai Mahasiswa."><i class="la la-cogs mt-2"></i> Input Nilai</a>';
    }
    public function download_nilai($crud = false)
    {
        return '<a class="btn btn-sm btn-link px-0" href="/'. $this->nilai_mitra . '" data-toggle="tooltip" title="Lihat Nilai dari Mitra."><i class="la la-file mt-2"></i> Nilai Mitra</a>';
    }

    public function lihatProgress($crud = false)
    {

        $btn = '<button class="btn btn-block btn-sm btn-link text-left px-0 active" data-toggle="modal" data-target="#progressNilai" type="button" aria-pressed="true">Lihat Progress</button>';

        $data = MbkmReport::with('regMbkm')->where('reg_mbkm_id', $this->id)->get();
        $modal = view('custom_view.lihatprogress', compact('data'));
        return $btn . $modal;
    }

    public function manageStudent($crud = false){
        $btn = '<a href="/admin/manage-student/' . $this->id . '/edit" class="btn btn-block btn-sm btn-link text-left px-0 active" type="button">Edit</a>';
        return $btn;
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

    public function involved()
    {
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