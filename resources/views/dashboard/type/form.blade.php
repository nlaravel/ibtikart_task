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
                                <form id="profile_update" >

                                   {{--<div class="row">--}}

                                        <div class="col-12 col-sm-6" >
 	 	 	 	 	 		 			 	<x-input.normal name="type.name" title="النوع" type="text"></x-input.normal>
 	 	 	 	 	 		 			</div>
 	 	 	 	 	 		 			 


                                    {{--</div>--}}
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <x-button  wire:click="save" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" title="{{__('lang.save')}}"></x-button>
                                    </div>
                                </form>
                                <!-- users edit account form ends -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

