<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AcctiveAccountMitraRequest;


use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


/**
 * Class AcctiveAccountMitraCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AcctiveAccountMitraCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\AcctiveAccountMitra::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/acctive-account-mitra');
        CRUD::setEntityNameStrings('acctive account mitra', 'validasi account mitra');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setValidation(AcctiveAccountMitraRequest::class);
        // CRUD::column("partner_name");
        // CRUD::column("address");
        // CRUD::column("phone");
        // CRUD::column("email");

        // CRUD::column("jenis_mitra");
        $this->crud->setColumns(['partner_name', 'address','phone','email','jenis_mitra',[
            'name'  => 'status',
   'label' => 'status ACC', // Table column heading
   'type'  => 'model_function',
   'function_name' => 'getStatusSpan'
        ]
    ]);
        // CRUD::addClause('where', 'status', '=', 'pending');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AcctiveAccountMitraRequest::class);



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
        // $this->setupCreateOperation();
        CRUD::setValidation(AcctiveAccountMitraRequest::class);

        // CRUD::field('partner_name');
        // CRUD::field('address');
        // CRUD::field('phone');
        // CRUD::field('email');
        CRUD::addField([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'select_from_array',
            'options' => [
                'accepted' => 'Accepted',
                'rejected' => 'Rejected',
                'pending' => 'Pending',
            ],
        ]);
        // CRUD::field("jenis_mitra");
    }

}
