@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

     
   <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">@if(session()->get('role')==1) {{strtoUpper(trans('constants.order'))}} @else {{strtoUpper(trans('constants.restaurant'))}} @endif {{strtoUpper(trans('constants.report'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a></li>
                <li class="breadcrumb-item"><a href="#">@if(session()->get('role')==1) {{strtoUpper(trans('constants.order'))}} @else {{strtoUpper(trans('constants.restaurant'))}} @endif {{strtoUpper(trans('constants.report'))}}</a>
                </li>
               
              </ol>
            </div>
          </div>
        </div>
        
      </div>
      <!-- <div class="card-content collapse show">
        <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/restaurant_report_filter">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          
                             
                            <div class="row">
                            <div class="col-md-4">
                             <div class="form-group">
                              <label for="email">From <span style="color: red;">*</span></label>
                             <input type="date" name="start" id="start" class="form-control">
                             
                            </div>
                          </div>
                              <div class="col-md-4">
                             <div class="form-group">
                              <label for="email">To <span style="color: red;">*</span></label>
                             <input type="date" name="end" id="end"   class="form-control">
                             </div>
                            </div>
                          

        

        <div class="col-xs-1">
           <div class="col-md-6 col-md-offset-3"> 
            <button type='submit' class='btn btn-info'> <i class="fa fa-search" aria-hidden="true"></i> Search </button>
               </div>
        </div>
      </form>
    </div>
  </div>
    </div><br> -->
      <div class="content-body">
        <!-- Basic form layout section start -->


         
       
      <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header"><br>
                  <h4 class="card-title"></h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      </ul>
                      </div>
                      
                    </div>
                </div>


               <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <div class="table-responsive">
                    <table id="orderwise_report" class="table table-striped table-bordered zero-configuration">
                      <thead> 
                          <tr>
                            <th>S.No</th>
                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Delivery Boy Name</th>
                            <th>Delivery Boy Phone</th>
                            @if(session()->get('role')==1)
                              <th>Restaurant Name</th>
                            @endif
                            <th>Order Amount</th>
                            <th>Delivery Charge</th>
                            <th>Restaurant Package Charge</th>
                            <th>Tax</th>
                            <th>Offer Discount</th>
                            <th>Restaurant Discount</th>
                            @if(session()->get('role')==1)
                              <th>Admin Comission</th>
                              <th>Delivery Boy Comission</th>
                            @endif
                            <th>Restaurant Commission</th>
                            @if(session()->get('role')==1)
                              <th>Payment Type</th>
                            @endif
                            <th>Status</th>
                          </tr>
                        </thead>
                        <!--<tbody>-->
                          <!--{{$s_no=1}}-->
                          <!-- @foreach($restaurant_details as $restaurant)
                          <tr>
                            <td>{{$s_no}}</td>
                            <td>{{$restaurant->order_id}}</td>
                            <td>{{$restaurant->customer_name}}</td>
                            <td>{{$restaurant->delivery_boy_name}}</td>
                            
                            <td>{{$restaurant->item_total}}</td>
                            <td>{{$restaurant->offer_discount}}</td>
                            <td>{{$restaurant->admin_commision}}</td>
                            <td>{{$restaurant->delivery_boy_commision}}</td>
                            <td>{{$restaurant->restaurant_commision}}</td>
                           
                          </tr>
                          <!--{{$s_no++}}-->
                         <!--@endforeach -->
                         
                          
                       <!--  </tbody> -->
                   

                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      
        <!-- // Basic form layout section end -->
      </div>
    </div>
  </div>
  <script>
           
  $(document).ready(function(){
      
      var table = $('#orderwise_report').DataTable({
          dom: "lBfrtip",
           buttons: [
        {
             extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A3',
                 
                customize: function (doc) { doc.defaultStyle.fontSize =7.2;  doc.styles.tableHeader.fontSize = 10; }

            },
             'excel','csv','print','copy',
            ],
          paging: true,
          //pageLength: 10,
          "searching": true,
          "ordering": false,
          "info": true,
          "lengthChange": true,
          "bProcessing": true,
          "bServerSide": true,
          "sAjaxSource": "orderwise_report_pagination",
          columns: [
              { data: "id" },
              { data: "order_id" },
              { data: "customer_name" },
              { data: "customer_phone" },
              { data: "delivery_boy_name" },
              { data: "delivery_boy_phone" },
              @if(session()->get('role')==1)
              { data: "restaurant_name" },
              @endif
              { data: "item_total" },
              { data: "delivery_charge" },
              { data: "restaurant_packaging_charge"},
              { data: "tax" },
              { data: "offer_discount" },
              { data: "restaurant_discount" },
              @if(session()->get('role')==1)
              { data: "admin_commision" },
              { data: "delivery_boy_commision" }, 
              @endif
              { data: "restaurant_commision" },
              @if(session()->get('role')==1)
              { data: "payment_type" },
              @endif
              { data: "status" },
          ]
          

      });



    });

</script>
  @endsection
 

 


