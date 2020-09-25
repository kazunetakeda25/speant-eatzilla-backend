@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">ADD SUB ADMIN</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=" ">SUB ADMIN LIST</a>
                </li>
                <li class="breadcrumb-item"><a href=" ">ADD SUB ADMIN</a>
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
                    <form action="{{url('/')}}/admin/add_dispmanager" id="addform" method="post" class="icons-tab-steps wizard-notification">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="eventName2">Name <span style="color: red;">*</span></label>
                              <input type="text" class="form-control" required id="name" name="name" placeholder="Name">
                            </div>

                           <div class="form-group">
                              <label for="email">Email <span style="color: red;">*</span></label>
                             <input type="text" class="form-control" required id="email" name="email" placeholder="Email">
                             
                            </div>

                            <div class="form-group">
                              <label for="password">Password <span style="color: red;">*</span></label>
                             <input type="Password" class="form-control" required id="password" name="password" placeholder="Password">
                             
                            </div>

                            <div class="form-group">
                              <label for="password">Confirm Password <span style="color: red;">*</span></label>
                             <input type="Password" class="form-control" required id="confirm_password" placeholder="Confirm Password">
                             <span class="error_message" id="password_error"></span>
                            </div>

                            <div class="form-group">
                              <label for="number">Phone Number <span style="color: red;">*</span></label>
                              <input type="text" class="form-control" id="number" name="phone" required placeholder="Phone Number" required="" >  
                            </div>

                            <div class="form-group">
                              <label for="number">Access Privileges</label>
                            </div>
                            <div class="row">
                              <div class="col-md-6 main-menu-content">
                                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                                  <li class="active nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(1);" title="Super Admin Dashboard">Super Admin Dashboard</a>
                                  </li>
                                  <li class="active nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(21);" title="Availablity Map">Availablity Map</a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="javascript:;" onclick="ChangePrivilegeBox(2);" title="Order Management">Order Management</a>
                                  </li> 
                                  <li class="nav-item">
                                    <a href="javascript:;" onclick="ChangePrivilegeBox(3);" title="Restaurant">Restaurant</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(4);" title="City Management">City Management</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(5);" title="Food Management">Food Management</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(6);" title="Driver Management">Driver Management</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(7);" title="Document Management">Document Management</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(8);" title="Cancellation Reasons">Cancellation Reasons</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(9);" title="Promocodes">Promocodes</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(10);" title="Restaurant Banner">Restaurant Banner</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(11);" title="Popular Brand">Popular Brand</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(12);" title="User Management">User Management</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(13);" title="Cuisines List">Cuisines List</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(14);" title="Addons List">Addons List</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(15);" title="Payout">Payout</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(16);" title="Food Quantity">Food Quantity</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(17);" title="Category">Category</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(18);" title="CMS MAnagement">CMS Management</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(19);" title="Settings">Settings</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:;" onclick="ChangePrivilegeBox(20);" title="Reports">Reports</a>
                                  </li>
                                </ul>
                                <span class='error' id="privilage_err" style="display:none;color:red">Please check any one privilages required</span>
                              </div>
                              <div class="col-md-6">
                                <div class="pm_menu" id="pm_1" style="height:300px;">
                                  <h4>Super Admin Dashboard</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('main_dashboard[]',this)"/><small class="checkmark"></small></label></div>
                                  <ul class="privilage_opt_bordered">
                                    <li>
                                      <span>Dashboard</span><i>:</i>
                                      <label class="stylish_check">View &nbsp;<input type="checkbox" name="main_dashboard[]" value="1"><small class="checkmark"></small></label>
                                    </li>                   				
                                  </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_21" style="display:none;">
                                  <h4>Availability Map</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('availability_map[]',this)"/><small class="checkmark"></small></label></div>
                                  <ul class="privilage_opt_bordered">
                                    <li>
                                      <span>Availability Map</span><i>:</i>
                                      <label class="stylish_check">View&nbsp;<input type="checkbox" name="availability_map[]" value="1"><small class="checkmark"></small></label>
                                    </li>               				
                                  </ul>
                                  </div>
                                  
                                <div class="pm_menu" id="pm_2" style="display:none;">
                                  <h4>Order Management</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('order_dashboard[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Order Dashboard</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="order_dashboard[]" value="1"><small class="checkmark"></small></label>
                                      </li>  
                                      <li>
                                        <span>New Order</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="order_dashboard[]" value="2"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>Processing Order</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="order_dashboard[]" value="3"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>Order Pickup</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="order_dashboard[]" value="4"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>Delivered Order</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="order_dashboard[]" value="5"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>Cancelled Order</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="order_dashboard[]" value="6"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Pickup Order</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="order_dashboard[]" value="7"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Dining Order</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="order_dashboard[]" value="8"><small class="checkmark"></small></label>
                                      </li>                 				
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_3" style="display:none;">
                                  <h4>Restaurant Management</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('restaurant[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Restaurant</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="restaurant[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="restaurant[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="restaurant[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="restaurant[]" value="4"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Status Update&nbsp;<input type="checkbox" name="restaurant[]" value="5"><small class="checkmark"></small></label>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_4" style="display:none;">
                                  <h4>City Management</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('city[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>City</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="city[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="city[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="city[]" value="3"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>Area</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="city[]" value="4"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="city[]" value="5"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="city[]" value="6"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>Country</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="city[]" value="7"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="city[]" value="8"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="city[]" value="9"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Make Default&nbsp;<input type="checkbox" name="city[]" value="10"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>State</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="city[]" value="11"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="city[]" value="12"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="city[]" value="13"><small class="checkmark"></small></label>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_5" style="display:none;">
                                  <h4>Food Management</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('food[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Food List</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="food[]" value="1"><small class="checkmark"></small></label>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_6" style="display:none;">
                                  <h4>Driver Management</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('driver[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Driver</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="driver[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="driver[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="driver[]" value="3"><small class="checkmark"></small></label>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_7" style="display:none;">
                                  <h4>Document Management</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('document[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Document</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="document[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="document[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="document[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="document[]" value="4"><small class="checkmark"></small></label>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_8" style="display:none;">
                                  <h4>Cancellation Reason</h4>
                                  <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('resaon[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Reason</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="resaon[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="resaon[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="resaon[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="resaon[]" value="4"><small class="checkmark"></small></label>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_9" style="display:none;">
                                    <h4>Promocodes</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('promocode[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Promocode</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="promocode[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="promocode[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="promocode[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="promocode[]" value="4"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>Custom Push</span><i>:</i>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="promocode[]" value="5"><small class="checkmark"></small></label>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_10" style="display:none;">
                                    <h4>Restaurant Banner</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('banner[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="banner[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="banner[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="banner[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="banner[]" value="4"><small class="checkmark"></small></label>
                                      </li>                                      
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_11" style="display:none;">
                                    <h4>Popular Brands</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('popular_brand[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="popular_brand[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="popular_brand[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="popular_brand[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="popular_brand[]" value="4"><small class="checkmark"></small></label>
                                      </li>                                      
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_12" style="display:none;">
                                    <h4>User Management</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('users[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="users[]" value="1"><small class="checkmark"></small></label>
                                      </li>                                      
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_13" style="display:none;">
                                    <h4>Cuisines List</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('cuisines[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                      <label class="stylish_check">View&nbsp;<input type="checkbox" name="cuisines[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="cuisines[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="cuisines[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="cuisines[]" value="4"><small class="checkmark"></small></label>
                                      </li>                                      
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_14" style="display:none;">
                                    <h4>Addons</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('cuisines[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="addons[]" value="1"><small class="checkmark"></small></label>
                                      </li>                                      
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_15" style="display:none;">
                                    <h4>Payouts</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('payout[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Restaurant Payout</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="payout[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Make Payment&nbsp;<input type="checkbox" name="payout[]" value="2"><small class="checkmark"></small></label>
                                      </li>
                                      <li>
                                        <span>Driver Payout</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="payout[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Make Payment&nbsp;<input type="checkbox" name="payout[]" value="4"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Restaurant Transaction History</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="payout[]" value="5"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Driver Transaction History</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="payout[]" value="6"><small class="checkmark"></small></label>
                                      </li>                                      
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_16" style="display:none;">
                                    <h4>Food Quantity</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('food_quantity[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                      <label class="stylish_check">View&nbsp;<input type="checkbox" name="food_quantity[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="food_quantity[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="food_quantity[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="food_quantity[]" value="4"><small class="checkmark"></small></label>
                                      </li>                                      
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_17" style="display:none;">
                                    <h4>Category</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('category[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                      <label class="stylish_check">View&nbsp;<input type="checkbox" name="category[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="category[]" value="2"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="category[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Delete&nbsp;<input type="checkbox" name="category[]" value="4"><small class="checkmark"></small></label>
                                      </li>                                      
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_18" style="display:none;">
                                    <h4>CMS Management</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('cms[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>About Us</span><i>:</i>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="cms[]" value="1"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>FAQ</span><i>:</i>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="cms[]" value="2"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Help</span><i>:</i>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="cms[]" value="3"><small class="checkmark"></small></label>
                                      </li>                                       
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_19" style="display:none;">
                                    <h4>Settings</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('settings[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Site Settings</span><i>:</i>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="settings[]" value="1"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Google Settings</span><i>:</i>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="settings[]" value="2"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Email Settings</span><i>:</i>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="settings[]" value="3"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Email Template</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="settings[]" value="4"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Add&nbsp;<input type="checkbox" name="settings[]" value="5"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Edit&nbsp;<input type="checkbox" name="settings[]" value="6"><small class="checkmark"></small></label>
                                      </li>                                     
                                    </ul>
                                  </div>
                                  <div class="pm_menu" id="pm_20" style="display:none;">
                                    <h4>Reports</h4>
                                    <div class="check_role_div">All &nbsp;<label class="stylish_check_all"><input type="checkbox" onchange="doAll('report[]',this)"/><small class="checkmark"></small></label></div>
                                    <ul class="privilage_opt_bordered">
                                      <li>
                                        <span>Restaurant Report</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="report[]" value="1"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Export&nbsp;<input type="checkbox" name="report[]" value="2"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Delivery Boy Report</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="report[]" value="3"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Export&nbsp;<input type="checkbox" name="report[]" value="4"><small class="checkmark"></small></label>
                                      </li> 
                                      <li>
                                        <span>Order Report</span><i>:</i>
                                        <label class="stylish_check">View&nbsp;<input type="checkbox" name="report[]" value="5"><small class="checkmark"></small></label>
                                        <label class="stylish_check">Export&nbsp;<input type="checkbox" name="report[]" value="6"><small class="checkmark"></small></label>
                                      </li>                                       
                                    </ul>
                                  </div>
                                  
                              </div>
                             <!-- <div class="form-group row">
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
                              <button type="submit" onclick="javascript:return form_validation();" class="btn btn-primary mr-1" style="padding: 10px 15px;">
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
   

    @endsection     
 
@section('script')

<script>

  function ChangePrivilegeBox(type) {
		//alert(type);
		$('.pm_menu').hide();
		$('#pm_'+type).show();
  }
  
  function doAll(type,checkboxElem) {
	  if (checkboxElem.checked) {	    
	    $("input[name='"+type+"']").prop('checked', true);
	  } else {
	    $("input[name='"+type+"']").prop('checked', false);
	  }
	}

  function form_validation()
  {
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('confirm_password').value;
    if(password != confirm_password)
    {
      $('#password_error').fadeIn().html('Password and Confirm Password does not match').delay(3000).fadeOut('slow');
      $('#confirm_password').focus();
      return false;
    }
    $('#privilage_err').hide();
    var total_privileages = $('#addform input[type=checkbox]:checked').length;
    if(total_privileages>0)
    {
      return true;
    }else
    {
      $('#privilage_err').show();
      return false;
    }
    // else
    // {
    //   document.getElementById("add_driver").submit();
    // }
  }

</script>

@endsection