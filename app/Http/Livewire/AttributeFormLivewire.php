<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\PublicFunction;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Traits\Alert;
use App\Models\Attribute;
class AttributeFormLivewire extends Component
{
     use WithFileUploads,Alert,PublicFunction;
      public $title = "";
      public $file_name = 'attribute';
      public $attribute;
      public $image;
      protected $listeners = ['Attribute-livewire:conformDelete' => 'conformDelete','reviewSectionRefresh' => '$refresh',];
       protected $rules = [
                "attribute.name"=>'nullable',

       ];

       protected $validationAttributes;
       public function __construct($id = null)
       {
           parent::__construct($id);
           $this->validationAttributes = $this->getColNameForValidation(Attribute::getColumnLang());
       }
      public function mount($id =null)
          {
              $this->title = \Lang::get('lang.add_account')  ;
              $this->attribute  = $id?Attribute::find($id):new Attribute();
          }
      public function render()
          {
              return view('dashboard/attribute/form')->extends('dashboard_layout.main');
          }

      public function save(){
            $this->validate();
           \DB::beginTransaction();
           try {
               $this->attribute->save();
                \DB::commit();
               $this->showModal(\Lang::get('lang.saved_done'),\Lang::get('lang.saved_changed'),'success');
               return redirect()->route('dashboard.attribute');
            } catch (\Exception $e) {
                    \DB::rollback();
                    $this->showModal('حصل خطأ ما',$e->getMessage(),'error');
            }
       }

}


