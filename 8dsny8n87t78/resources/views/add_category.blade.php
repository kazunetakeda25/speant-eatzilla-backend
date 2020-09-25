@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">CREATE CATEGORY</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/category_list">CATEGORY</a>
                </li>
                <li class="breadcrumb-item"><a href="#">ADD CATEGORY</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        
      </div>
      <div class="content-body">
        <section id="icon-tabs">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">&nbsp;</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>

                <div class="card-content collapse show">
                  <div class="card-body">
                    <form action="{{url('/')}}/admin/add_to_category" class="icons-tab-steps wizard-notification" method="post">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if(isset($data))
                        <input type="hidden" class="form-control" value="{{$data->id}}" name="id" >
                         @endif
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="eventName2">Name :</label>
                              <input type="text" name="category_name" class="form-control" id="Name" value="@if(isset($data->category_name)) {{$data->category_name}} @endif"  placeholder="Name" required>
                            </div>
<!-- 
                             <div class="form-group">
                              <label for="lastName2">Description :</label>
                              <textarea name="Description" id="Description" rows="4" class="form-control"></textarea>
                             
                            </div> -->
                            
                             <!-- <div class="form-group">
                              <p>Shop: WaterFall Food Restaurant</p>
                             </div> -->

                             <div class="form-group">
                              <label for="Resturant">Status :</label>
                               <select class="c-select form-control" id="Status" name="status">
                                  @if(isset($data->status))
                                @if($data->status==1)
                                <option value="1">Active</option>
                                @else
                                <option value="0">Inactive</option>
                                @endif
                                @endif
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                               </select>
                             </div>

                            <!--  <div class="form-group">
                              <label for="featured">Category order : </label>
                               <input type="number" class="form-control" value="" id="Category_order" name="Category_order">
                             </div> -->
                          
                           <!--   <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Image</label>
                               <div class="col-md-9">
                                 <img id="blah" src="http://placehold.it/180" alt="your image" / style="max-width:180px;"><br>
                                 <input type='file' onchange="readURL(this);" / style="padding:10px;background:000;">
                               </div>
                              </div> -->

                             <div class="form-actions">
                              <button type="button" class="btn btn-warning mr-1" style="padding: 10px 15px;">
                               <i class="ft-x"></i> Cancel
                                </button>
                              <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                               <i class="ft-check-square"></i> Save
                                </button>
                            </div>
                           </div>
                          </div>
                         </fieldset>
                        </form>
                       </div>
                      </div>
                     </div>
                    </div>
                   </div>
                  </section>
                 </div>
                </div>
     <script>
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

    @endsection     
 