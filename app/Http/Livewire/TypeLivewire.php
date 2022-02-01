<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\PublicFunction;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Traits\Alert;
use App\Models\Type;
class TypeLivewire extends Component
{
     use WithFileUploads,Alert,PublicFunction,WithPagination;
        public $columes;
        public $searchable;
        public $page_length = 10;
        public $sortBy="created_at";
        public $sortDirection="desc";
        protected $paginationTheme = 'bootstrap';
        public  $search_array=[];
        protected $listeners = ['Type-livewire:conformDelete' => 'conformDelete','reviewSectionRefresh' => '$refresh',];
        public $file_name = 'type';
        public function mount()
            {


                $this->columes =Type::getColumnLang();

                $this->page_length = request()->query('page_length',$this->page_length);
            }


        public function render()
           {
               $data =Type::query();
               $data=$data->orderBy($this->sortBy,$this->sortDirection)->paginate($this->page_length);

                    return view('dashboard/type/index',[ 'data'=>$data])->extends('dashboard_layout.main');


           }



            public function edit($id){
                 return redirect()->route('dashboard.type.edit',$id);
             }

             public function delete($id){
                 $this->showConfirmation(\Lang::get('lang.confirm_delete'),\Lang::get('lang.please_confirm_delete'),'Type-livewire:conformDelete',['id'=>$id]);
             }

             public function conformDelete($id){

                 Type::find($id['id'])->delete();

                 $this->showModal(\Lang::get('lang.saved_done'),\Lang::get('lang.saved_changed'),'success');

             }
}

