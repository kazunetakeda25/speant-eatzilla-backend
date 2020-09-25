@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')


   <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.restaurant'))}} {{strtoUpper(trans('constants.report'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                </li>
                <li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.restaurant'))}} {{strtoUpper(trans('constants.report'))}}</a>
                </li>
               
              </ol>
            </div>
          </div>
        </div>
        <!-- <div class="content-header-right col-md-6 col-12">
          <div class="dropdown float-md-right">
            <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
            <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item" href="#"><i class="la la-calendar-check-o"></i> Calender</a>
              <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
              <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
            </div>
          </div>
        </div> -->
      </div>
      <div class="content-body">
        
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
                    <table id="restaurant_report" class="table table-striped table-bordered zero-configuration">
                      <thead> 
                          <tr>
                            <th>S.No</th>
                            <th>Restaurant Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ratings</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Area</th>
                            <th>Total Orders</th>
                            <th>Total Restaurant Earnings</th>
                            <th>Pending Payouts</th>
                            <th>Payouts Completed</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <!-- <tbody> -->
                          <!--{{$s_no=1}}-->
                          <!-- @foreach($restaurant_details as $restaurant)
                          <tr>
                            <td>{{$s_no}}</td>
                            <td>{{$restaurant->restaurant_name}}</td>
                            <td>{{$restaurant->email}}</td>
                            <td>{{$restaurant->phone}}</td>
                            <td>{{$restaurant->rating}}</td>
                            <td>{{$restaurant->address}}</td>
                            <td>{{$restaurant->city}}</td>
                            <td>{{$restaurant->area}}</td>
                            <td>{{$restaurant->restaurant_commision}}</td>
                            <td>{{$restaurant->admin_commision}}</td>
                           -->  
                            
                            <!-- <td>
                              <div class="dropdown center">
                              <button class="btn btn-primary dropdown-toggle round btn-glow px-2 p-0" id="button3"
                              type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                              <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
                              <a class="dropdown-item" href="{{url('/')}}/admin/admin_report_view/{{$restaurant->id}}"><i class="la la-bookmark-o"></i> view</a>
                              </div>
                              </div>
                            </td> -->
                          <!-- </tr> -->
                          <!--{{$s_no++}}-->
                         <!-- @endforeach -->
                         
                          
                        <!-- </tbody> -->
                   

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
      
      var table = $('#restaurant_report').DataTable({
        
          dom: "lBfrtip",
          
           buttons: [
        {
             extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A3',
                 
                customize: function (doc) { doc.defaultStyle.fontSize =7.2;  doc.styles.tableHeader.fontSize = 15; }

            },
             'excel','csv','print','copy',
            ],
          paging: true,
          //pageLength: 10,
          "searching": true,
          "ordering": true,
          "info": true,
          "lengthChange": true,
          "bProcessing": true,
          "bServerSide": true,
          "sAjaxSource": "restaurant_report_pagination",
           
          
          // "sAjaxSource": function ( data, callback, settings ) {

          //     $.ajax({
          //         url: 'restaurant_report_pagination',
          //         dataType:"json",
          //         type: 'post',
          //         contentType: 'application/x-www-form-urlencoded',
          //         data: {
          //             "_token": "{{ csrf_token() }}",
          //             //RecordsStart: data.start,
          //             //PageSize: data.length
          //         },
          //         success: function( data, textStatus, jQxhr ){
          //             console.log(data);
          //             callback({
          //                 data: data.Data,
          //                 recordsTotal:  data.TotalRecords,
          //                 recordsFiltered:  data.RecordsFiltered
          //             });
          //         },
          //         error: function( jqXhr, textStatus, errorThrown ){
          //         }
          //     });
          // },
          columns: [
              { data: "id" },
              { data: "restaurant_name" },
              { data: "email" },
              { data: "phone" },
              { data: "rating" },
              { data: "address" },
              { data: "city" },
              { data: "area" }, 
              { data: "total_orders" } ,     
              { data: "restaurant_commision" },
              { data: "pending_payout" } ,                       
              { data: "payout_done" },                        
          ]
        

      });



    });

</script>




@endsection  