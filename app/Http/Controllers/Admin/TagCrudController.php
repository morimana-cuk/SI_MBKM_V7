<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Tag');
        $this->crud->setRoute("admin/tag");
        $this->crud->setEntityNameStrings('tag', 'tags');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns(['name', 'slug']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TagRequest::class);

      
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Tag name"
          ]);
          $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => "URL Segment (slug)"
          ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
