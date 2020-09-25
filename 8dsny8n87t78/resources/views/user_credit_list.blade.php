@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')

  <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">USER CREDITS</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/user_list">USER LIST</a>
                </li>
                <li class="breadcrumb-item"><a href="#">PENDING APPROVAL CREDITS</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Basic form layout section start -->


        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                    <h4 class="card-title" style="height:50px;color:red;">
                  </h4>
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
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead> 


                          <tr>
                            <th>SI.No</th>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Credit Amount</th>
                            <th>Credit Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; ?>
                          @foreach($user_detail as $key)
                          <tr>
                            <td>{{$i}}</td>
                            <td>@isset($key->users->name) {{$key->users->name}} @endisset</td>
                            <td>@isset($key->users->phone) {{$key->users->phone}} @endisset</td>
                            <td>{{DEFAULT_CURRENCY_SYMBOL." ".$key->amount}}</td>
                            <td>{{date('Y-m-d h:i a',strtotime($key->created_at))}}</td>  
                            <td><a href="{{url('/')}}/admin/view_credit_details/{{$key->user_id}}" class="btn btn-sm btn-primary">View Details</a></td>                          
                          </tr>
                          <?php $i++; ?>
                          @endforeach
                        </tbody>
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
  

    @endsection     
 