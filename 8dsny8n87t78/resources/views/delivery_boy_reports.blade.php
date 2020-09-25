@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

   <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.delivery_people'))}} {{strtoUpper(trans('constants.report'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a></li>
                <li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.delivery_people'))}} {{strtoUpper(trans('constants.report'))}}</a>
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
      <!-- <div class="card-content collapse show">
        <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/delivery_boy_report_filter">
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


         
         <!-- Pie Chart -->
       <!-- <section id="card">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Weekly & Monthly Reports</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
           <div class="row">
            <div class="col-xl-6 col-lg-12 mb-2">
              <div class="card text-white box-shadow-0 bg-info1">
                <div class="card-header1">
                  <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-dollar background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">{{$current_week}}</h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Current Week Earnings</h3>  
                      </div>
                    </div>
                </div> 
              </div>
              <div class="card text-white box-shadow-0 bg-info1">
                <div class="card-header2">
                  <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-dollar background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">{{$current_month}}</h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Current Month Earnings</h3>    
                      </div>
                    </div>
                </div>  
              </div>
            <div class="card text-white box-shadow-0 bg-info1">
                <div class="card-header3">
                  <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-dollar background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">{{$last_week}}</h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Last Week Earnings</h3>         
                      </div>
                    </div>
                </div>  
              </div>
                 <div class="card text-white box-shadow-0 bg-info1">
                    <div class="card-header4">
                     <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-dollar background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">{{$last_month}}</h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Last Month Earnings</h3>    
                        </div>
                       </div>
                       </div>    
                      </div>
                      </div>

                      <div class="col-xl-6 col-lg-12"> <br><br> 
                       <div class="card-content collapse show">
                        <div class="card-body">
                         <div id="pie-chart"></div>
                        </div>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
        </section> -->

          <!-- <section id="card-1">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Yearly Reports</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                    <div class="row">
                      <div class="col-xl-6 col-lg-12 mb-2"><br><br>
                         <div class="card text-white box-shadow-0 bg-info1">
                          <div class="card-header3">
                           <div class="row text-white">
                             <div class="col-6">
                              <h1><i class="la la-dollar background-round text-white"></i></h1>
                                <h4 class="pt-1 m-0 text-white">{{$last_year}}</h4>
                         </div>
                       <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Last Year Earnings</h3>
                        
                      </div>
                    </div>
                  </div>      
                </div>
               <div class="card text-white box-shadow-0 bg-info1">
                <div class="card-header4">
                  <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-dollar background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">{{$current_year}}</h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Current Year Earnings</h3>                 
                      </div>
                    </div>
                </div>  
              </div>
             </div>
                      <div class="col-xl-6 col-lg-12">
                       <div class="card-content collapse show">
                        <div class="card-body">
                          <div id="pie-chart1"></div>
                         </div>
                        </div>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        </section> -->
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
                    <table id="deliveryboy_report" class="table table-striped table-bordered zero-configuration">
                      <thead> 
                          <tr>
                            <th>S.No</th>
                            
                            <th>Delivery Boy Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            
                            <th>Vehicle Name</th>
                            <th>Address</th>
                            <th>Ratings</th>
                            <th>Total Orders</th>
                            <th>Total Earnings</th>
                            <th>Pending Payouts</th>
                            <th>Payouts Completed</th>
                           <!--  <th>Total Delivery Boy Earnings</th>
                            <th>Total Admin Earnings</th> -->
                           <!--  <th>Action</th> -->
                          </tr>
                        </thead>
                        <!-- <tbody> -->
                          <!--{{$s_no=1}}-->
                         <!--  @foreach($delivery_boy_details as $delivery_report)
                          <tr>
                            <td>{{$s_no}}</td>
                            
                            <td>{{$delivery_report->name}}</td>
                            <td>{{$delivery_report->email}}</td>
                            <td>{{$delivery_report->phone}}</td>
                            <td>{{$delivery_report->city}}</td>
                            
                            <td>{{$delivery_report->vehicle_name}}</td>
                            <td>{{$delivery_report->address_line_1}}</td>
 -->                           
                            
                            
                            <!-- <td>
                              <div class="dropdown center">
                              <button class="btn btn-primary dropdown-toggle round btn-glow px-2 p-0" id="button3"
                              type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                              <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
                              <a class="dropdown-item" href="{{url('/')}}/admin/admin_report_view"><i class="la la-bookmark-o"></i> view</a>
                              </div>
                              </div>
                            </td> -->
                          <!-- </tr> -->
                          <!--{{$s_no++}}-->
                        <!--  @endforeach
                         
                          
                        </tbody>
                    -->

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
      
      var table = $('#deliveryboy_report').DataTable({
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
          "sAjaxSource": "deliveryboy_report_pagination",
          
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
              { data: "name" },
              { data: "email" },
              { data: "phone" },
              { data: "city" },
              { data: "vehicle_name" },
              { data: "address_line_1" },
              { data: "ratings" },
              { data: "total_orders" },
              { data: "total_earnings" },
              { data: "pending_payout" },
              { data: "payout_done" }
          ]
          

      });



    });

</script>

@endsection
 


