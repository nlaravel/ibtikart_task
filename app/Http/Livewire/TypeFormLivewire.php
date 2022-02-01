<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\PublicFunction;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Traits\Alert;
use App\Models\Type;
class TypeFormLivewire extends Component
{
     use WithFileUploads,Alert,PublicFunction;
      public $title = "";
      public $file_name = 'type';
      public $type;
      public $image;
      protected $listeners = ['Type-livewire:conformDelete' => 'conformDelete','reviewSectionRefresh' => '$refresh',];
       protected $rules = [
                "type.name"=>'nullable',

       ];

       protected $validationAttributes;
       public function __construct($id = null)
       {
           parent::__construct($id);
           $this->validationAttributes = $this->getColNameForValidation(Type::getColumnLang());
       }
      public function mount($id =null)
          {
              $this->title = \Lang::get('lang.add_account')  ;
              $this->type  = $id?Type::find($id):new Type();
          }
      public function render()
          {
              return view('dashboard/type/form')->extends('dashboard_layout.main');
          }

      public function save(){
            $this->validate();
           \DB::beginTransaction();
           try {
               $this->type->save();
                \DB::commit();
               $this->showModal(\Lang::get('lang.saved_done'),\Lang::get('lang.saved_changed'),'success');
               return redirect()->route('dashboard.type');
            } catch (\Exception $e) {
                    \DB::rollback();
                    $this->showModal('حصل خطأ ما',$e->getMessage(),'error');
            }
       }

}


