<?php

namespace App\Http\Livewire;

use App\Models\AmountProduct;
use App\Models\ProductAttribute;
use App\Models\ProductColor;
use App\Models\SizeProduct;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use App\Traits\PublicFunction;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Traits\Alert;
use App\Models\Product;
class ProductFormLivewire extends Component
{
     use WithFileUploads,Alert,PublicFunction;
      public $title = "";
      public $product;
      public $image1=null;
      public $image;
    public $image_main=null;
      public $types_selected=[];
    public $images = [['image'=>null]];
    public $amount_images = [['image'=>null]];
    public $size_images = [['image'=>null]];
    public $i = 1;
    public $inputs = [['attribute_id'=>'']];
    public $color_options = [['image'=>'','image_url'=>null,'color_name'=>'','color'=>'','price'=>'','description'=>'']];

    public $amout_options = [['image'=>'','image_url'=>null,'amount'=>'','price'=>'','description'=>'']];
    public $size_options = [['image'=>'','image_url'=>null,'size'=>'','price'=>'','description'=>'']];
      protected $listeners = ['Product-livewire:conformDelete' => 'conformDelete','reviewSectionRefresh' => '$refresh',];
       protected $rules = [
                'image_main'=>'required',
                "product.title"=>'nullable',
                "product.price"=>'nullable',
                "product.type_id"=>'nullable',
                "product.description"=>'nullable',

       ];

       protected $validationAttributes;
       public function __construct($id = null)
       {
           parent::__construct($id);
           $this->validationAttributes = $this->getColNameForValidation(Product::getColumnLang());
       }
      public function mount($id =null)
          {
              $this->title = \Lang::get('lang.add_account')  ;
              $this->product  = $id?Product::find($id):new Product();

              /* INPUT DATA */
              $input_result = array();
              $input_array =$id?ProductAttribute::where('product_id',$this->product->id)->get()->toArray():[];


              foreach ($input_array as $key => $value) {
                  $id =$key;
                  if (!isset($input_result[$id])) {
                      $input_result[$id] = [];
                  }

                  $input_result[$id]['attribute_id'] =$value['attribute_id'];


              }

              $this->inputs= $input_result;
             //  dd($this->inputs);


              /* color  DATA */

              $color_result = array();
              $color_array =$id?ProductColor::where('product_id',$this->product->id)->get()->toArray():[];


              foreach ($color_array as $key => $value) {
                  $id =$key;
                  if (!isset($color_result[$id])) {
                      $color_result[$id] = [];
                  }

                  $color_result[$id]['image'] =$value['image'];
                  $color_result[$id]['image_url'] =$value['image_url'];
                  $color_result[$id]['color_name'] =$value['color_name'];
                  $color_result[$id]['color'] =$value['color'];
                  $color_result[$id]['price'] =$value['price'];
                  $color_result[$id]['description'] =$value['description'];


              }


              $this->color_options= $color_result;


              /* amount  DATA */

              $amount_result = array();
              $amount_array =$id?AmountProduct::where('product_id',$this->product->id)->get()->toArray():[];


              foreach ($amount_array as $key => $value) {
                  $amount_id =$key;
                  if (!isset($amount_result[$id])) {
                      $amount_result[$amount_id] = [];
                  }

                  $amount_result[$amount_id]['image'] =$value['image'];
                  $amount_result[$amount_id]['image_url'] =$value['image_url'];
                  $amount_result[$amount_id]['amount'] =$value['amount'];
                  $amount_result[$amount_id]['price'] =$value['price'];
                  $amount_result[$amount_id]['description'] =$value['description'];


              }


              $this->amout_options= $amount_result;


              /* size  DATA */

              $size_result = array();
              $size_array =$id?SizeProduct::where('product_id',$this->product->id)->get()->toArray():[];


              foreach ($size_array as $key => $value) {
                  $size_id =$key;
                  if (!isset($size_result[$id])) {
                      $size_result[$size_id] = [];
                  }

                  $size_result[$size_id]['image'] =$value['image'];
                  $size_result[$size_id]['image_url'] =$value['image_url'];
                  $size_result[$size_id]['size'] =$value['size'];
                  $size_result[$size_id]['price'] =$value['price'];
                  $size_result[$size_id]['description'] =$value['description'];


              }


              $this->size_options= $size_result;
          }


      public function render()
          {
              return view('dashboard/product/form')->extends('dashboard_layout.main');
          }

    public function add()
    {

        $values=['attribute_id'=>''];
        $this->inputs[]=$values;

    }

    public function add_color_options()
    {

        $values=['image'=>'','image_url'=>null,'color_name'=>'','color'=>'','price'=>'','description'=>''];
        $image_values=['image'=>'',];
        $this->color_options[]=$values;
        $this->images[]=$image_values;

    }

    public function add_amout_options()
    {

        $values=['image'=>'','image_url'=>null,'amount'=>'','price'=>'','description'=>''];
        $image_values=['image'=>'',];
        $this->amout_options[]=$values;
        $this->amount_images[]=$image_values;

    }

    public function remove_amout_options($i)
    {

        unset($this->amount_images[$i]);
        unset($this->amout_options[$i]);
        $this->amout_options = array_values($this->amout_options);
        $this->amount_images = array_values($this->amount_images);

    }

    public function add_size_options()
    {

        $values=['image'=>'','image_url'=>null,'size'=>'','price'=>'','description'=>''];
        $image_values=['image'=>'',];
        $this->size_options[]=$values;
        $this->size_images[]=$image_values;

    }


    public function remove_size_options($i)
    {

        unset($this->size_images[$i]);
        unset($this->size_options[$i]);
        $this->size_options = array_values($this->size_options);
        $this->size_images = array_values($this->size_images);

    }


    public function remove($i)
    {

        unset($this->inputs[$i]);

        $this->inputs = array_values($this->inputs);

    }

    public function remove_color_options($i)
    {

        unset($this->images[$i]);
        unset($this->color_options[$i]);
        $this->color_options = array_values($this->color_options);
        $this->images = array_values($this->images);

    }





      public function save(){
            $this->validate();
           \DB::beginTransaction();
           try {

               $image_filename = $this->image_main? $this->image_main->store('/','product'):$this->product->image;
               $this->product->image=$image_filename;
               $this->product->save();

               if($this->inputs){
                   foreach ($this->inputs as $input_key=> $input_value){
                   ProductAttribute::create([
                       'product_id' => $this->product->id,
                       'attribute_id' => $input_value['attribute_id'],
                    ]);
                   }

               }

               if($this->color_options){
                   foreach ($this->color_options as $key=> $value){

                       $filename = $this->images[$key]['image']? $this->images[$key]['image']->store('/','product'):$value['image'];
                       ProductColor::create([
                           'color_name' => $value['color_name'],
                           'color' =>$value['color'],
                           'price' => $value['price'],
                           'description' => $value['description'],
                           'product_id' => $this->product->id,
                           'image' => $filename
                       ]);

                   }

               }
               if($this->amout_options){
                   foreach ($this->amout_options as $ammount_key=> $ammount_value){

                       $filename = $this->amount_images[$ammount_key]['image']? $this->amount_images[$ammount_key]['image']->store('/','product'):$ammount_value['image'];
                       AmountProduct::create([
                           'amount' => $ammount_value['amount'],
                           'description' => $ammount_value['description'],
                           'price' => $ammount_value['price'],
                           'product_id' => $this->product->id,
                           'image' => $filename
                       ]);

                   }

               }
               if($this->size_options){
                   foreach ($this->size_options as $size_key=> $size_value){

                       $filename = $this->size_images[$size_key]['image']? $this->size_images[$size_key]['image']->store('/','product'):$size_value['image'];
                       SizeProduct::create([
                           'size' => $size_value['size'],
                           'description' => $size_value['description'],
                           'price' => $size_value['price'],
                           'product_id' => $this->product->id,
                           'image' => $filename
                       ]);

                   }

               }
                \DB::commit();
               $this->showModal(\Lang::get('lang.saved_done'),\Lang::get('lang.saved_changed'),'success');
               return redirect()->route('dashboard.product');
            } catch (\Exception $e) {
                    \DB::rollback();
                    $this->showModal('حصل خطأ ما',$e->getMessage(),'error');
            }
       }




}


