<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StatusRegRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StatusRegCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StatusRegCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\RegisterMbkm::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/status-reg');
        CRUD::setEntityNameStrings('status reg', 'Program Saya');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->setColumns([[
            'name' => 'mbkm.partner.partner_name',
            'label' => 'Nama Instansi',
        ],[
            'name' => 'mbkm.program_name',
            'label' => 'Nama Program',
        ], [
            'name' => 'mbkm.start_date',
            'label' => 'Tanggal Mulai',
        ], [
            'name' => 'mbkm.end_date',
            'label' => 'Tanggal Selesai',
        ],[
            'name'  => 'status',
            'label' => 'Status', // Table column heading
            'type'  => 'model_function',
            'function_name' => 'getStatusSpan'
        ],]);
        CRUD::addClause('where', 'student_id', '=', backpack_auth()->user()->id);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StatusRegRequest::class);

        

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