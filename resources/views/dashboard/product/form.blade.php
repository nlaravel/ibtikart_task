@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin-layout/app-assets/css/pages/app-ecommerce-shop.css')}}">
    <style>
        #wishlist .card, .card .card {
            box-shadow: 0 4px 10px 0 rgb(0 0 0 / 10%) !important;
        }
        .img-upload{
            display: inline-block;
            position: relative;
            height: 63px;
            width: 63px;
            box-shadow: 0px 5px 15px 0px rgba(0,0,0,0.25);
            border-radius: 50%;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .img-upload img{
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
        .img-upload .uploader{
            position: absolute;
            top: 0px;
            right: 0px;
            height: 63px;
            width: 63px;
            border-radius: 50%;
            opacity: 0;
            cursor: pointer;
        }
        .upload-edit{
            position: absolute;
            bottom: 0px;
            left: 0px;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            color: #fff;
            background-color: #3cec6a;
            border-radius: 50%;
            font-size: 11px;
        }
    </style>
@endpush
<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"></h2>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">
        <!-- users edit start -->
        <section class="users-edit">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">

                                <!-- users edit account form start -->
                                <div id="profile_update" >

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="img-upload mr-2">


                                                    @if($image_main)


                                                        <img src="{{$image_main?$image_main->temporaryUrl():asset('images/upload.png')}}" alt="" id="image_main">
                                                    @else
                                                        <img src="{{$product?$product->image_url:asset('images/upload.png')}}" alt="" id="image_main">
                                                    @endif


                                                <input type="file" class="uploader" wire:model="image_main" >

                                                <div class="upload-edit"><i class="far fa-edit"></i></div>
                                                <div wire:loading wire:target="image_main"  class="upload-edit"><i class="fas fa-spinner fa-spin"></i></div>


                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6" >
                                            <x-input.normal name="product.title" title="العنوان" type="text"></x-input.normal>
                                        </div>
                                        <div class="col-12 col-sm-6" >
                                            <x-input.normal name="product.price" title="السعر" type="text"></x-input.normal>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <?php $types=\App\Models\Type::all(); ?>

                                            <x-input.select  wire:model="product.type_id"
                                                             value="name"
                                                             :options="$types"
                                                             name="product.type_id"
                                                             id="type_id"
                                                             title="اختر النوع" >
                                            </x-input.select>
                                        </div>

                                    </div>
                                    <div class="row mb-t">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="mb-0">اضافة خصائص للمنتج</h4>
                                                    <button  class="btn btn-primary" wire:click="add()"  id="AddRow">اضافة خاصية جديدة للمنتج </button>
                                                </div>
                                                <div class="card-content">
                                                    <div class="row mt-1 mb-2 ml-1">

                                                        @foreach($inputs  as $key =>$value)
                                                            <div class="col-12 col-sm-6" >

                                                                <?php $attributes=\App\Models\Attribute::all(); ?>

                                                                <x-input.select  wire:model="inputs.{{$key}}.attribute_id"
                                                                                 value="name"
                                                                                 :options="$attributes"
                                                                                 name="inputs.{{$key}}.attribute_id"
                                                                                 id="attr_{{$key}}"
                                                                                 title="اختر الخاصية" >
                                                                </x-input.select>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <button type="button"  wire:click="remove({{$key}})" class="btn btn-outline-danger waves-effect waves-light deletefile"> حذف<i class="feather icon-trash"></i></button>

                                                            </div>


                                                            @if($inputs[$key]['attribute_id']==1)
                                                                <div class="col-12 mt-5">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4 class="mb-0">اضافة اسماء الخاصية</h4>
                                                                            <button wire:click="add_color_options()" type="button" class="btn btn-outline-success waves-effect waves-light deletefile"> اضافة خيارات <i class="feather icon-plus"></i></button>
                                                                        </div>
                                                                        <div class="card-content">
                                                                            <div class="table-responsive mt-1">
                                                                                <table class="table table-hover-animation mb-0">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>الصورة</th>
                                                                                        <th>اسم اللون</th>
                                                                                        <th>اللون</th>
                                                                                        <th> السعر المضاف على السعر الأساسي</th>
                                                                                        <th> الوصف</th>
                                                                                        <th> الاجراءات</th>

                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($color_options  as $color_key =>$value)
                                                                                        <tr>

                                                                                            <td>

                                                                                                <div class="img-upload mr-2">

                                                                                                    @if(isset($images[$color_key]))
                                                                                                    @if($images[$color_key]['image'])


                                                                                                        <img src="{{$images[$color_key]['image']?$images[$color_key]['image']->temporaryUrl():asset('images/upload.png')}}" alt="" id="output{{$color_key}}">
                                                                                                    @else
                                                                                                        <img src="{{$color_options[$color_key]['image_url']?$color_options[$color_key]['image_url']:asset('images/upload.png')}}" alt="" id="output{{$color_key}}">
                                                                                                    @endif
                                                                                                    @else
                                                                                                        <img src="{{$color_options[$color_key]['image_url']?$color_options[$color_key]['image_url']:asset('images/upload.png')}}" alt="" id="output{{$color_key}}">
                                                                                                    @endif
                                                                                                    <input type="file" class="uploader" wire:model="images.{{$color_key}}.image" >

                                                                                                    <div class="upload-edit"><i class="far fa-edit"></i></div>
                                                                                                    <div wire:loading wire:target="images.{{$color_key}}.image"  class="upload-edit"><i class="fas fa-spinner fa-spin"></i></div>


                                                                                                </div>


                                                                                            </td>

                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="color_options.{{$color_key}}.color_name" title="اسم اللون" ></x-input.normal>
                                                                                            </td>

                                                                                            <td>
                                                                                                <x-input.normal  type="color" name="color_options.{{$color_key}}.color" title=" اللون" ></x-input.normal>
                                                                                            </td>

                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="color_options.{{$color_key}}.price" title=" السعر" ></x-input.normal>
                                                                                            </td>

                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="color_options.{{$color_key}}.description" title="الوصف" ></x-input.normal>
                                                                                            </td>
                                                                                            <td>
                                                                                                <button type="button"  wire:click="remove_color_options({{$color_key}})" class="btn btn-outline-danger waves-effect waves-light deletefile"> حذف<i class="feather icon-trash"></i></button>

                                                                                            </td>

                                                                                        </tr>

                                                                                    @endforeach



                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            @if($inputs[$key]['attribute_id']==3)
                                                                <div class="col-12 mt-5">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4 class="mb-0">اضافة اسماء الخاصية</h4>
                                                                            <button wire:click="add_amout_options()" type="button" class="btn btn-outline-success waves-effect waves-light deletefile"> اضافة خيارات <i class="feather icon-plus"></i></button>
                                                                        </div>
                                                                        <div class="card-content">
                                                                            <div class="table-responsive mt-1">
                                                                                <table class="table table-hover-animation mb-0">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>الصورة</th>
                                                                                        <th>الحجم</th>
                                                                                        <th> السعر المضاف على السعر الأساسي</th>
                                                                                        <th> الوصف</th>
                                                                                        <th> الاجراءات</th>

                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($amout_options  as $amout_key =>$value)
                                                                                        <tr>

                                                                                            <td>
                                                                                                <div class="img-upload mr-2">


                                                                                                    @if(isset($amount_images[$amout_key]))
                                                                                                    @if($amount_images[$amout_key]['image'])


                                                                                                        <img src="{{$amount_images[$amout_key]['image']?$amount_images[$amout_key]['image']->temporaryUrl():asset('images/upload.png')}}" alt="" id="output{{$amout_key}}">
                                                                                                    @else
                                                                                                        <img src="{{$amout_options[$amout_key]['image_url']?$amout_options[$amout_key]['image_url']:asset('images/upload.png')}}" alt="" id="output{{$amout_key}}">
                                                                                                    @endif
                                                                                                    @else
                                                                                                        <img src="{{$amout_options[$amout_key]['image_url']?$amout_options[$amout_key]['image_url']:asset('images/upload.png')}}" alt="" id="output{{$amout_key}}">
                                                                                                    @endif
                                                                                                    <input type="file" class="uploader" wire:model="amount_images.{{$amout_key}}.image" >

                                                                                                    <div class="upload-edit"><i class="far fa-edit"></i></div>
                                                                                                    <div wire:loading wire:target="amount_images.{{$amout_key}}.image"  class="upload-edit"><i class="fas fa-spinner fa-spin"></i></div>


                                                                                                </div>


                                                                                            </td>

                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="amout_options.{{$amout_key}}.amount" title="الحجم" ></x-input.normal>
                                                                                            </td>



                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="amout_options.{{$amout_key}}.price" title=" السعر" ></x-input.normal>
                                                                                            </td>

                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="amout_options.{{$amout_key}}.description" title="الوصف" ></x-input.normal>
                                                                                            </td>
                                                                                            <td>
                                                                                                <button type="button"  wire:click="remove_amout_options({{$amout_key}})" class="btn btn-outline-danger waves-effect waves-light deletefile"> حذف<i class="feather icon-trash"></i></button>

                                                                                            </td>

                                                                                        </tr>

                                                                                    @endforeach



                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            @if($inputs[$key]['attribute_id']==4)
                                                                <div class="col-12 mt-5">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4 class="mb-0">اضافة اسماء الخاصية</h4>
                                                                            <button wire:click="add_size_options()" type="button" class="btn btn-outline-success waves-effect waves-light deletefile"> اضافة خيارات <i class="feather icon-plus"></i></button>
                                                                        </div>
                                                                        <div class="card-content">
                                                                            <div class="table-responsive mt-1">
                                                                                <table class="table table-hover-animation mb-0">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>الصورة</th>
                                                                                        <th>المقاس</th>
                                                                                        <th> السعر المضاف على السعر الأساسي</th>
                                                                                        <th> الوصف</th>
                                                                                        <th> الاجراءات</th>

                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($size_options  as $size_key =>$value)
                                                                                        <tr>

                                                                                            <td>
                                                                                                <div class="img-upload mr-2">


                                                                                                    @if(isset($size_images[$size_key]))
                                                                                                        @if($size_images[$size_key]['image'])


                                                                                                            <img src="{{$size_images[$size_key]['image']?$size_images[$size_key]['image']->temporaryUrl():asset('images/upload.png')}}" alt="" id="output{{$size_key}}">
                                                                                                        @else
                                                                                                            <img src="{{$size_options[$size_key]['image_url']?$size_options[$size_key]['image_url']:asset('images/upload.png')}}" alt="" id="output{{$size_key}}">
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <img src="{{$size_options[$size_key]['image_url']?$size_options[$size_key]['image_url']:asset('images/upload.png')}}" alt="" id="output{{$size_key}}">
                                                                                                    @endif
                                                                                                    <input type="file" class="uploader" wire:model="size_images.{{$size_key}}.image" >

                                                                                                    <div class="upload-edit"><i class="far fa-edit"></i></div>
                                                                                                    <div wire:loading wire:target="size_images.{{$size_key}}.image"  class="upload-edit"><i class="fas fa-spinner fa-spin"></i></div>


                                                                                                </div>


                                                                                            </td>

                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="size_options.{{$size_key}}.size" title="المقاس" ></x-input.normal>
                                                                                            </td>



                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="size_options.{{$size_key}}.price" title=" السعر" ></x-input.normal>
                                                                                            </td>

                                                                                            <td>
                                                                                                <x-input.normal  type="text" name="size_options.{{$size_key}}.description" title="الوصف" ></x-input.normal>
                                                                                            </td>
                                                                                            <td>
                                                                                                <button type="button"  wire:click="remove_size_options({{$size_key}})" class="btn btn-outline-danger waves-effect waves-light deletefile"> حذف<i class="feather icon-trash"></i></button>

                                                                                            </td>

                                                                                        </tr>

                                                                                    @endforeach



                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                         @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <x-button  wire:click="save" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" title="{{__('lang.save')}}"></x-button>
                                    </div>
                                </div>
                                <!-- users edit account form ends -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

