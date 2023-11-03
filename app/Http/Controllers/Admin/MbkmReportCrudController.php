<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MbkmReportRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\MbkmReport;
use App\Models\RegisterMbkm;
use App\Models\Mbkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
/**
 * Class MbkmReportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MbkmReportCrudController extends CrudController
{
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    
    public function viewReport() {
        $crud = $this->crud;

        $mbkmId = RegisterMbkm::with('mbkm')
        ->where('student_id', backpack_auth()->user()->id)
        ->where('status',  'accepted')
        ->whereHas('mbkm', function ($query) {
            $now = Carbon::now();
            $query->whereDate('start_date', '<=', $now)
                  ->whereDate('end_date', '>=', $now);
        })->orderBy('id', 'desc')->get();
        if(isset($mbkmId[0])) {
                $reports = MbkmReport::with('regMbkm')
            ->whereHas('regMbkm', function ($query) use ($mbkmId) {
                $query->where('student_id', backpack_auth()->user()->id)
                    ->where('mbkm_id', $mbkmId[0]->id);
            })->get();
            $acceptedCount = $reports->where('status', 'accepted')->count();
            $targetCount = Mbkm::where('id', $mbkmId[0]->mbkm_id)->value('task_count');

            $count = ($acceptedCount / $targetCount) * 100;
            // return dd($count);
            $today = Carbon::now()->toDateString();
            
            return view('vendor/backpack/crud/report_mbkm', compact('crud', 'reports', 'today', 'count'));
        }else{
            \Alert::error('Anda tidak terdaftar di program MBKM')->flash();
            return back();
        }
        
    }
    public function upReport(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            \Alert::warning($messages[0])->flash();
            return back()->withInput();
        }
        $input = $request->all();

        $file = $request->file('file')->getClientOriginalName();
        $fileName = time().'.'.$request->file('file')->getClientOriginalExtension();

        $request->file('file')->move(public_path('storage/uploads'), $fileName);
        $input['file'] = "storage/uploads/$fileName";
        $user = MbkmReport::create($input);
        \Alert::success('Berhasil upload laporan!')->flash();
        return back();
    }

    public function revReport(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf'
        ]);
    
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            \Alert::warning($messages[0])->flash();
            return back()->withInput();
        }
        $report = MbkmReport::where('id', $request->id)->first();
        
        // Hapus file yang ada
        $existingFilePath = $report->file;
        if (file_exists(public_path($existingFilePath))) {
            unlink(public_path($existingFilePath));
        }
    
        // Simpan file yang baru
        $file = $request->file('file')->getClientOriginalName();
        $fileName = time().'.'.$request->file('file')->getClientOriginalExtension();
    
        $request->file('file')->move(public_path('storage/uploads'), $fileName);
        $report->file = "storage/uploads/$fileName";
        $report->save();
    
        \Alert::success('Berhasil mengupdate laporan!')->flash();
        return back();
    }

    public function downloadFile(Request $request) {
        $filePath = public_path($request->file);
        $headers = [
            'Content-Type' => 'application/pdf', // Ganti sesuai tipe file yang ingin Anda unduh
        ];
        return Response::download($filePath, $fileName, $headers);
    }
    
    public function setup()
    {
        CRUD::setModel(\App\Models\MbkmReport::class);
        // CRUD::setModel(\App\Models\RegisterMbkm::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/mbkm-report');
        CRUD::setEntityNameStrings('mbkm report', 'mbkm reports');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // return dd($this->crud);
        $this->crud->setColumns(['regMbkm.student_id', 'reg_mbkm_id', 'file', 'status', 'upload_date']);
        // CRUD::addClause('where', 'student_id', '=', '1');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MbkmReportRequest::class);

        CRUD::field('id');
        CRUD::field('report_mbkm_id');
        CRUD::field('file');
        CRUD::field('status');
        CRUD::field('upload_date');
        CRUD::field('created_at');
        CRUD::field('updated_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}