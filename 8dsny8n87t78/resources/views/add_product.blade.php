@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')
<style>
@media (min-width: 768px) and (max-width: 1024.98px){
.col-md-1.checkbox-1 {
    flex: 0px;
    max-width: 25%;
}
.col-md-2.small-font {
    max-width: 25%;
}
.col-md-5.checkbox-2 {
    max-width: 25%;
}
.col-md-4.make-default {
    max-width: 25%;
}
} 
@media (min-width: 425px) and (max-width: 767.98px){
 .col-md-1.checkbox-1 {
    max-width: 50%;
}
.col-md-2.small-font {
    max-width: 50%;
}
.col-md-5.checkbox-2 {
    max-width: 50%;
}
.col-md-4.make-default {
   max-width: 50%; 
   padding: 10px;
 }
} 
@media (min-width: 375px) and (max-width: 424.98px){
 .col-md-1.checkbox-1 {
    max-width: 50%;
}
.col-md-2.small-font {
    max-width: 50%;
}
.col-md-5.checkbox-2 {
    max-width: 50%;
}
.col-md-4.make-default {
   max-width: 50%; 
   padding: 10px;
 }
} 
@media (min-width: 320px) and (max-width: 374.98px){
 .col-md-1.checkbox-1 {
    max-width: 50%;
}
.col-md-2.small-font {
    max-width: 50%;
}
.col-md-5.checkbox-2 {
    max-width: 50%;
}
.col-md-4.make-default {
   max-width: 50%; 
   padding: 10px;
 }
} 
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>


    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.add'))}} {{strtoUpper(trans('constants.product'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/product_list">{{strtoUpper(trans('constants.product'))}} {{strtoUpper(trans('constants.list'))}}</a>
                </li>
                <li class="breadcrumb-item"><a href="">{{strtoUpper(trans('constants.add'))}} {{strtoUpper(trans('constants.product'))}}</a>
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
                  <h4 class="card-title"></h4>
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
                    <form action="{{url('/')}}/admin/add_to_product" method="post" class="icons-tab-steps wizard-notification" enctype="multipart/form-data">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <fieldset>
                      
                        <div class="row">
                          <div class="col-md-6">
                            @if(session()->get('role')==1)
                              <div class="form-group">
                                  <label for="eventName2">Restaurant<span style="color: red;">*</span></label>
                                  <select name="restaurant_name" id="restaurant_id" onchange="getrestaurant_based_detail()" class="form-control" required="">
                                    @foreach($restaurant as $res)
                                      @if(isset($res->restaurant_name))
                                        <option value="{{$res->id}}" @if(old('restaurant_name')==$res->id) selected @endif>{{$res->restaurant_name}}</option>
                                    @endif
                                    @endforeach
                                </select> 
                              </div>
                            @else
                              <input type="hidden" value="{{session()->get('userid')}}" id="restaurant_id">
                            @endif

                            <div class="form-group">
                              <label for="eventName2">Name <span style="color: red;">*</span></label>
                              <input type="text" class="form-control" required name="name" id="Name" value="{{old('name')}}">
                            </div>
                             <div class="form-group">
                              <label for="lastName2">Description <span style="color: red;">*</span></label>
                              <textarea  id="Description" name="description" required rows="4" class="form-control">{{old('description')}}</textarea>
                             
                            </div>
                            <div class="form-group">
                              <label for="eventLocation2">Category <span style="color: red;">*</span></label>
                              <select class="c-select form-control" id="Category" name="category" required>
                                <option value="">Select Category..</option>
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}" @if(old('category')==$cat->id) selected @endif>{{$cat->category_name}}</option>
                                @endforeach
                              </select>
                            </div>
                             <div class="form-group">
                              <label for="eventLocation2">Menu <span style="color: red;">*</span></label>
                              <select class="c-select form-control" id="menu" name="menu" required>
                                <option value="">Select Menu..</option>
                                @foreach($menu as $m)
                                <option value="{{$m->id}}" @if(old('menu')==$m->id) selected @endif>{{$m->menu_name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                            <label for="eventLocation2">Pure Veg</label>
                            <label class="radio-inline">
                                <input type="radio" value="0" name="food_type" @if(old('food_type')==0) checked @endif>No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="1" name="food_type" @if(old('food_type')==1) checked @else checked="" @endif>Yes
                            </label>

                            </div>
                             <div class="form-group">
                              <label for="eventName2">Status<span style="color: red;">*</span></label>
                             <label class="switch">
                              <input type="checkbox" name="status" value="1" checked="">                        
                              <span class="slider round"></span></label>
                           </div>
                            <!--  <div class="form-group">
                               <label for="percentage">Product Order :</label>
                                 <input type="number" class="form-control" id="Product_Order" name="position" value=" ">
                             </div> -->
                           <!--   <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Image</label>
                             <div class="col-md-9">   
                               <img id="blah" src="http://placehold.it/180" alt="your image" / style="max-width:180px;"><br>
                                <input type='file' onchange="readURL(this);" / style="padding:10px;background:000;">
                              </div>
                             </div> -->
                           <!--  <div class="form-group">
                             <label for="featured">Featured Position</label>
                              <input type="number" min="0" class="form-control" value="1" id="featured_position" name="featured_position">
                            </div> --> 
                          </div>
                          <div class="col-md-6">
                             <!-- <div class="form-group row">
                             <label for="image">Featured Image : </label>
                               <p>Note:- Please upload Image size 252x152 for featured Product</p>  
                                <label class="col-md-3 label-control" for="projectinput4">Image</label>
                              <div class="col-md-9">  
                                <img id="blah1" src="http://placehold.it/180" alt="your image" / style="max-width:180px;"><br>
                                 <input type='file' name="image" onchange="readURL1(this);" / style="padding:10px;background:000;">
                               </div>
                             </div> -->
                            <div class="form-group">
                              <h3><label>Pricing </label></h3>
                              <hr>
                            </div>
                            <div class="form-group">
                              <label for="eventName2">Price <span style="color: red;">*</span></label>
                              <input type="text" name="price" value="{{old('price')}}" required class="form-control" id="price">
                            </div> 
                            <!-- <div class="form-group">
                              <label for="eventName2">Tax in %<span style="color: red;">*</span></label>
                              <input type="text" name="tax" class="form-control" required id="price">
                            </div>  -->
                            <div class="form-group">
                              <label for="eventName2">Packaging Charge <span style="color: red;">*</span></label>
                              <input type="text" name="packaging_charge" value="{{old('packaging_charge')}}" required class="form-control" id="price">
                            </div> 

                            <div class="form-group">
                              <h3><label>{{trans('constants.addon')}}</label></h3>
                              <hr>
                            </div>
                            <div class="form-group">
                              <label for="eventName2"></label>
                              <select name="add_ons[]" id="add_ons" class="form-control select2" multiple="multiple">
                                @if(isset($add_ons))
                                  @foreach($add_ons as $val)
                                    <option value="{{$val->id}}" @if(isset($addon_ids)) {{ (in_array($val->id,$addon_ids)) ? 'selected' : '' }} @endif>{{$val->name}}</option>
                                  @endforeach
                                @endif
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="eventName2">Food Image</label><br>
                              <input type="file" name="image" id="image" onchange="GetFileSize()" class="form-control">
                            </div> 

                            

                             

                            

                           <!--  <div class="form-group">
                                <label for="addons">Addons List</label>                     
                                <p><input type="checkbox" name="addons[71]" value="71">Extra cheese</p>
                                <p>Price</p>
                                <p><input type="text" class="form-control" name="addons_price[71]" value="0"></p> 
                            </div> -->
                           <!--   <div class="form-group">              
                                <p><input type="checkbox" name="addons[71]" value="71">Extra olives</p>
                                <p>Price</p>
                                <p><input type="text" class="form-control" name="addons_price[71]" value="0"></p> 
                            </div> -->
                          <!--   <div class="form-group">              
                                <p><input type="checkbox" name="addons[71]" value="71">Double layer cheese</p>
                                <p>Price</p>
                                <p><input type="text" class="form-control" name="addons_price[71]" value="0"></p> 
                            </div> -->
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <h3><label>{{trans('constants.food_qty')}}</label></h3>
                              <hr>
                            </div>
                            <div class="form-group">
                                <h5>Default quantity price will be the food price</h5>

                                @if(isset($food_quantity))
                                  @php $i=1; @endphp
                                  @foreach($food_quantity as $val)
                                    <div class="row">
                                      <div class="col-md-1 checkbox-1">
                                        <input type="checkbox" name="food_quantity[]" onclick="funchangePrice({{$val->id}})" value="{{$val->id}}" id="food_quantity_{{$val->id}}" class="chk form-control" @if(isset($food_quantity_list) && in_array($val->id, $food_quantity_list)) checked @endif>
                                      </div>
                                      <div class="col-md-2 small-font">
                                        {{$val->name}}
                                      </div>
                                      <div class="col-md-5 checkbox-2">
                                        <input type="text" name="food_quantity_price[{{$val->id}}]" onblur="funchangePrice({{$val->id}})" id="food_quantity_price_{{$val->id}}" class="form-control">
                                      </div>
                                      <div class="col-md-4 make-default">
                                        <label class="radio-inline">
                                          <input type="radio" value="{{$val->id}}" onclick="funchangePrice({{$val->id}})" name="food_quantity_default" id="food_quantity_default_{{$val->id}}">Make default
                                        </label>
                                      </div>
                                    </div><br />
                                  @php $i=$i+1; @endphp
                                  @endforeach
                                @endif
                          </div>
                            
                            <br><br>
                            <div class="form-actions">
                              <button type="button" class="btn btn-warning mr-1" style="padding: 10px 15px;">
                               <i class="ft-x"></i> Cancel
                                </button>
                              <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                               <i class="ft-check-square"></i> Save
                                </button>
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <h3><label>Offer Settings</label></h3>
                                <hr>
                              </div>
                              <div class="form-group">
                                <label for="percentage">Discount Type </label>
                                  <select class="c-select form-control" id="status" name="discount_type">
                                    <option value="1" >Flat Offer</option>
                                    <option value="2" >Percentage Offer</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="percentage">Target Amount </label>
                                    <input type="text" class="form-control floating-label" name="target_amount" >
                                </div>
                                  <div class="form-group">
                                    <label for="percentage">Offer Amount </label>
                                    <input type="text" class="form-control floating-label" name="offer_amount" >
                                 </div>
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
  $(document).ready(function() {
    var restaurant_id = $('#restaurant_id').val();
    $.ajax({
      url : "{{url('/')}}/admin/getrestaurant_based_detail/"+restaurant_id,
      method : "get",
      success : function (data)
      {
      console.log(data.menu);
        if(data.add_ons != '') 
        {
          var add_ons='';
          $.each( data.add_ons, function( key, value ) {
            add_ons += '<option value="'+value.id+'">'+value.name+'</option>';
          });
          $('#add_ons').html(add_ons);
        }
        else
        {
            $('#add_ons').html("");
        }
        if(data.menu != '') 
        {
          var menu='';
          $.each( data.menu, function( key, value ) {
            menu += '<option value="'+value.id+'">'+value.menu_name+'</option>';
          });
          $('#menu').html(menu);
        }
        else
        {
            $('#menu').html("");
        }
      }
    });
  });

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
            function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah1')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        function funchangePrice(id)
        {
          var price = $('#food_quantity_price_'+id).val();
          if(price!=''){
            if($('#food_quantity_default_'+id).is(':checked')){
              if($("#food_quantity_"+id).is(':checked')){
                $('#price').val(price);
              }else{
                alert('Food quantity checkbox is mandtory');
                $("#food_quantity_"+id).prop('checked',true);
              }
            }else{
              if(!$("#food_quantity_"+id).is(':checked')){
              //}else{
                alert('Food quantity checkbox is mandtory');
                $("#food_quantity_"+id).prop('checked',true);
              }
            }
          }else{
            if($('#food_quantity_default_'+id).is(':checked')){
              if($("#food_quantity_"+id).is(':checked')){
                alert('Food quantity price is mandtory');
                $("#food_quantity_price_"+id).val('0');
              }else{
                alert('Food quantity checkbox and price is mandtory');
                $("#food_quantity_"+id).prop('checked',true);
                $("#food_quantity_price_"+id).val('0');
              }
            }else{
              if($("#food_quantity_"+id).is(':checked')){
                alert('Food quantity price is mandtory');
                $("#food_quantity_price_"+id).val('0');
              }
            }
          }
        }

        function getrestaurant_based_detail()
        {
          var restaurant_id = $('#restaurant_id').val();
          $.ajax({
            url : "{{url('/')}}/admin/getrestaurant_based_detail/"+restaurant_id,
            method : "get",
            success : function (data)
            {
            console.log(data.menu);
              if(data.add_ons != '') 
              {
                var add_ons='';
                $.each( data.add_ons, function( key, value ) {
                  add_ons += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('#add_ons').html(add_ons);
              }
              else
              {
                  $('#add_ons').html("");
              }
              if(data.menu != '') 
              {
                var menu='';
                $.each( data.menu, function( key, value ) {
                  menu += '<option value="'+value.id+'">'+value.menu_name+'</option>';
                });
                $('#menu').html(menu);
              }
              else
              {
                  $('#menu').html("");
              }
            }

          });
        }

    function GetFileSize() {
        var fi = document.getElementById('image');
        if (fi.files.length > 0) {
           
            for (var i = 0; i <= fi.files.length - 1; i++) {

                var fsize = fi.files.item(i).size; 
                var fsize1= Math.round((fsize / 1024));
                if(fsize1>=3000){
                alert("The File shouldn't exceed 3MB");
                var remove = $("#image").val('');
                }
                
            }
        }
    }          
</script>
  
  <!-- <script src="{{URL::asset('public/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script> -->
<script src="{{URL::asset('public/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('public/app-assets/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script>

    @endsection     
 