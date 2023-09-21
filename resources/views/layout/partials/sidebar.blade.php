@if(Route::is(['index-one','index-three'])) 
  <!-- Sidebar -->
  @if(!Route::is(['index-three']))
  <div class="sidebar new-header">
    @endif
    @if(Route::is(['index-three']))
    <div class="sidebar side-three new-header">
    @endif
    @if(Route::is(['index-three']))
    <div class="container">
    @endif
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="nav">
                <li class="submenu">
                    <a href="index" ><img src="assets/img/icons/menu-icon.svg" alt="img"><span> Main Menu</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="index" ><img src="assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Product</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="productlist">Product List</a></li>
                                <li><a href="addproduct">Add Product</a></li>
                                <li><a href="{{url('admin/category')}}">Category List</a></li>
                                <li><a href="{{url('admin/category/create')}}">Add Category</a></li>
                                <li><a href="subcategorylist">Sub Category List</a></li>
                                <li><a href="subaddcategory">Add Sub Category</a></li>
                                <li><a href="brandlist">Brand List</a></li>
                                <li><a href="addbrand">Add Brand</a></li>
                                <li><a href="importproduct">Import Products</a></li>
                                <li><a href="barcode">Print Barcode</a></li>
                            </ul>
                        </li>                                    
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span> Sales</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="saleslist">Sales List</a></li>
                                <li><a href="pos">POS</a></li>
                                <li><a href="pos">New Sales</a></li>
                                <li><a href="salesreturnlists">Sales Return List</a></li>
                                <li><a href="createsalesreturns">New Sales Return</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/purchase1.svg" alt="img"><span> Purchase</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="purchaselist">Purchase List</a></li>
                                <li><a href="addpurchase">Add Purchase</a></li>
                                <li><a href="importpurchase">Import Purchase</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/expense1.svg" alt="img"><span> Expense</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="expenselist">Expense List</a></li>
                                <li><a href="createexpense">Add Expense</a></li>
                                <li><a href="expensecategory">Expense Category</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/quotation1.svg" alt="img"><span> Quotation</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="quotationList">Quotation List</a></li>
                                <li><a href="addquotation">Add Quotation</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/transfer1.svg" alt="img"><span> Transfer</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="transferlist">Transfer  List</a></li>
                                <li><a href="addtransfer">Add Transfer </a></li>
                                <li><a href="importtransfer">Import Transfer </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/return1.svg" alt="img"><span> Return</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="salesreturnlist">Sales Return List</a></li>
                                <li><a href="createsalesreturn">Add Sales Return </a></li>
                                <li><a href="purchasereturnlist">Purchase Return List</a></li>
                                <li><a href="createpurchasereturn">Add Purchase Return </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> People</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="customerlist">Customer List</a></li>
                                <li><a href="addcustomer">Add Customer  </a></li>
                                <li><a href="supplierlist">Supplier List</a></li>
                                <li><a href="addsupplier">Add Supplier </a></li>
                                <li><a href="userlist">User List</a></li>
                                <li><a href="adduser">Add User</a></li>
                                <li><a href="storelist">Store List</a></li>
                                <li><a href="addstore">Add Store</a></li>
                            </ul>
                        </li>														
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/places.svg" alt="img"><span> Places</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="newcountry">New Country</a></li>
                                <li><a href="countrieslist">Countries list</a></li>
                                <li><a href="newstate">New State </a></li>
                                <li><a href="statelist">State list</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="newuser">New User </a></li>
                        <li><a href="userlists">Users List</a></li>
                    </ul>
                </li>
                <li  class="submenu">
                    <a href="javascript:void(0);"><i data-feather="layers"></i> <span> Components </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="components" ><i data-feather="layers"></i><span> Components</span> </a></li>									
                        <li  class="submenu">
                            <a href="javascript:void(0);"><i data-feather="box"></i> <span>Elements </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="sweetalerts">Sweet Alerts</a></li>
                                <li><a href="tooltip">Tooltip</a></li>
                                <li><a href="popover">Popover</a></li>
                                <li><a href="ribbon">Ribbon</a></li>
                                <li><a href="clipboard">Clipboard</a></li>
                                <li><a href="drag-drop">Drag & Drop</a></li>
                                <li><a href="rangeslider">Range Slider</a></li>
                                <li><a href="rating">Rating</a></li>
                                <li><a href="toastr">Toastr</a></li>
                                <li><a href="text-editor">Text Editor</a></li>
                                <li><a href="counter">Counter</a></li>
                                <li><a href="scrollbar">Scrollbar</a></li>
                                <li><a href="spinner">Spinner</a></li>
                                <li><a href="notification">Notification</a></li>
                                <li><a href="lightbox">Lightbox</a></li>
                                <li><a href="stickynote">Sticky Note</a></li>
                                <li><a href="timeline">Timeline</a></li>
                                <li><a href="form-wizard">Form Wizard</a></li>
                            </ul>
                        </li>
                        <li  class="submenu">
                            <a href="javascript:void(0);"><i data-feather="bar-chart-2"></i> <span> Charts  </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="chart-apex">Apex Charts</a></li>
                                <li><a href="chart-js">Chart Js</a></li>
                                <li><a href="chart-morris">Morris Charts</a></li>
                                <li><a href="chart-flot">Flot Charts</a></li>
                                <li><a href="chart-peity">Peity Charts</a></li>
                            </ul>
                        </li>
                        <li  class="submenu">
                            <a href="javascript:void(0);"><i data-feather="award"></i><span> Icons  </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="icon-fontawesome">Fontawesome Icons</a></li>
                                <li><a href="icon-feather">Feather Icons</a></li>
                                <li><a href="icon-ionic">Ionic Icons</a></li>
                                <li><a href="icon-material">Material Icons</a></li>
                                <li><a href="icon-pe7">Pe7 Icons</a></li>
                                <li><a href="icon-simpleline">Simpleline Icons</a></li>
                                <li><a href="icon-themify">Themify Icons</a></li>
                                <li><a href="icon-weather">Weather Icons</a></li>
                                <li><a href="icon-typicon">Typicon Icons</a></li>
                                <li><a href="icon-flag">Flag Icons</a></li>
                            </ul>
                        </li>
                        <li  class="submenu">
                            <a href="javascript:void(0);"><i data-feather="columns"></i> <span> Forms  </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="form-basic-inputs">Basic Inputs </a></li>
                                <li><a href="form-input-groups">Input Groups </a></li>
                                <li><a href="form-horizontal">Horizontal Form </a></li>
                                <li><a href="form-vertical"> Vertical Form </a></li>
                                <li><a href="form-mask">Form Mask </a></li>
                                <li><a href="form-validation">Form Validation </a></li>
                                <li><a href="form-select2">Form Select2 </a></li>
                                <li><a href="form-fileupload">File Upload </a></li>
                            </ul>
                        </li>
                        <li  class="submenu">
                            <a href="javascript:void(0);"><i data-feather="layout"></i> <span> Table  </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="tables-basic" >Basic Tables </a></li>
                                <li><a href="data-tables">Data Table </a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="blankpage" ><i data-feather="file"></i><span> Blank Page</span> </a>
                        </li>
                        <li  class="submenu">
                            <a href="javascript:void(0);"><i data-feather="alert-octagon"></i> <span> Error Pages  </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="error-404">404 Error </a></li>
                                <li><a href="error-500">500 Error </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Application</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="chat">Chat</a></li>
                        <li><a href="calendar">Calendar</a></li>
                        <li><a href="email">Email</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/time.svg" alt="img"><span> Report</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="purchaseorderreport">Purchase order report</a></li>
                        <li><a href="inventoryreport">Inventory Report</a></li>
                        <li><a href="salesreport">Sales Report</a></li>
                        <li><a href="invoicereport">Invoice Report</a></li>
                        <li><a href="purchasereport">Purchase Report</a></li>
                        <li><a href="supplierreport">Supplier Report</a></li>
                        <li><a href="customerreport">Customer Report</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img"><span> Settings</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="generalsettings">General Settings</a></li>
                        <li><a href="emailsettings">Email Settings</a></li>
                        <li><a href="paymentsettings">Payment Settings</a></li>
                        <li><a href="currencysettings">Currency Settings</a></li>
                        <li><a href="grouppermissions">Group Permissions</a></li>
                        <li><a href="taxrates">Tax Rates</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    @if(Route::is(['index-three']))
    </div>
    @endif
</div>
<!-- /Sidebar -->
@endif
<!-- Sidebar -->
@if(Route::is(['index-two']))
<div class="container">
@endif
@if(!Route::is(['index-one','index-two','index-three','index-four']))
<div class="sidebar" id="sidebar">
@endif
@if(Route::is(['index-one']))
<div class="sidebar sidebar-one hide-sidebar" id="sidebar">
@endif
@if(Route::is(['index-two']))
<div class="sidebar sidebar-two" id="sidebar">
@endif    
@if(Route::is(['index-three']))
<div class="sidebar sidebar-three hide-sidebar" id="sidebar">
@endif
@if(Route::is(['index-four']))
<div class="sidebar sidebar-four" id="sidebar">
@endif
    <div class="sidebar-inner slimscroll">
        @if(!Route::is(['index-four']))
        <div id="sidebar-menu" class="sidebar-menu">
            @endif
           
            @if(!Route::is(['index-two','index-four']))
            <ul>
                <li>

                    <a class="{{ Request::is('index') ? 'active' : '' }}" href="#" ><img src="{{ URL::asset('/assets/img/icons/dashboard.svg')}}" alt="img"><span> Dashboard</span> </a>
                </li>
                @foreach(nav() as $key=>$row)
                    @if(count($row['childs']) > 0)
                        <li class="submenu">
                            <a class="{{ Request::is('admin/product/*','admin/category/*','admin/subcategory/*','admin/brand/*','admin/import-products','admin/attribute/*') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/'.$row['icons'])}}" alt="img"><span> {{$row['name']}}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                @foreach($row['childs'] as $cRow)
                                    <li><a class="{{ Request::is('admin/product','admin/product/edit/*') ? 'active' : '' }}" href="{{url($cRow['path'])}}">{{$cRow['name']}}</a></li>
                                @endforeach

                            </ul>
                        </li>
                    @else
                        <li>
                            <a class="{{ Request::is('index') ? 'active' : '' }}" href="{{url($row['path'])}}" ><img src="{{ URL::asset('/assets/img/icons/'.$row['icons'])}}" alt="img"><span> {{$row['name']}}</span> </a>
                        </li>
                    @endif
                @endforeach


              

                <li class="submenu">
                    <a class="{{ Request::is('admin/product/*','admin/category/*','admin/subcategory/*','admin/brand/*','admin/import-products','admin/attribute/*') ? 'active' : '' }} href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/product.svg')}}" alt="img"><span> Product</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/product','admin/product/edit/*') ? 'active' : '' }}" href="{{route('admin.product.index')}}">Product List</a></li>
                        <li><a class="{{ Request::is('admin/product/create','product-details') ? 'active' : '' }}"href="{{route('admin.product.create')}}">Add Product</a></li>
                        <li><a class="{{ Request::is('admin/category', 'admin/category/edit/*') ? 'active' : '' }}"href="{{route('admin.category.index')}}">Category List</a></li>
                        <li><a class="{{ Request::is('admin/category/create') ? 'active' : '' }}"href="{{route('admin.category.create')}}">Add Category</a></li>
                        {{-- <li><a class="{{ Request::is('admin/subcategory', 'admin/subcategory/edit/*') ? 'active' : '' }}"href="{{route('admin.sub-category.index')}}">Sub Category List</a></li>
                        <li><a class="{{ Request::is('admin/subcategory/crate') ? 'active' : '' }}"href="{{route('admin.sub-category.create')}}">Add Sub Category</a></li> --}}
                        <li><a class="{{ Request::is('admin/brand', 'admin/brand/edit/*') ? 'active' : '' }}"href="{{route('admin.brand.index')}}">Brand List</a></li>
                        <li><a class="{{ Request::is('admin/brand/create') ? 'active' : '' }}"href="{{route('admin.brand.create')}}">Add Brand</a></li>
                        <li><a class="{{ Request::is('admin/import-products') ? 'active' : '' }}"href="{{route('admin.import-products')}}">Import Products</a></li>
                        {{-- <li><a class="{{ Request::is('barcode') ? 'active' : '' }}"href="{{url('barcode')}}">Print Barcode</a></li> --}}
                        {{-- <li><a class="{{ Request::is('admin/attribute','admin/attribute/edit/*') ? 'active' : '' }}"href="{{route('admin.attribute.index')}}">Attribute List</a></li>
                        <li><a class="{{ Request::is('admin/attribute/create') ? 'active' : '' }}"href="{{route('admin.attribute.create')}}">Add Attribute</a></li> --}}

                        <li><a class="{{ Request::is('admin/department','admin/department/edit/*') ? 'active' : '' }}"href="{{route('admin.department.index')}}">Department List</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ Request::is('admin/sales/*', 'admin/sale/return/edit','admin/pos','add-sales','sales-details','edit-sales','salesreturnlists') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/sales1.svg')}}" alt="img"><span> Sales</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/sales/*','') ? 'active' : '' }}" href="{{route('admin.sales.index')}}">Sales List</a></li>
                        <li><a class="{{ Request::is('admin/pos') ? 'active' : '' }}" href="{{route('admin.sales.create')}}">POS</a></li>
                        {{-- <li><a class="{{ Request::is('add-sales','edit-sales') ? 'active' : '' }}" href="{{url('add-sales')}}">New Sales</a></li> --}}
                        <li><a class="{{ Request::is('admin/sale/return','admin/sale/return/edit') ? 'active' : '' }}" href="{{route('admin.sales.return.index')}}">Sales Return List</a></li>
                        <li><a class="{{ Request::is('admin/sale/return/create') ? 'active' : '' }}" href="{{route('admin.sales.return.create')}}">New Sales Return</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ Request::is('admin/purchase/*') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/purchase1.svg')}}" alt="img"><span> Purchase</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/purchase','admin/purchase/edit/*') ? 'active' : '' }}" href="{{route('admin.purchase.index')}}">Purchase List</a></li>
                        <li><a class="{{ Request::is('admin/purchase/create') ? 'active' : '' }}" href="{{route('admin.purchase.create')}}">Add Purchase</a></li>
                        <li><a class="{{ Request::is('admin/import-purchase') ? 'active' : '' }}" href="{{route('admin.import-purchase')}}">Import Purchase</a></li>
                        <li><a class="{{ Request::is('admin/material-inward/*') ? 'active' : '' }}" href="{{route('admin.material-inward.index')}}">Material Inward</a></li>
                        <li><a class="{{ Request::is('admin/supplier-bills*') ? 'active' : '' }}" href="{{route('admin.supplier-bills.index')}}">Supplier Bill</a></li>

                        
                       
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ Request::is('expenselist','createexpense','editexpense','expensecategory') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/expense1.svg')}}" alt="img"><span> Expense</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('expenselist') ? 'active' : '' }}" href="{{url('expenselist')}}">Expense List</a></li>
                        <li><a class="{{ Request::is('createexpense','editexpense') ? 'active' : '' }}" href="{{url('createexpense')}}">Add Expense</a></li>
                        <li><a class="{{ Request::is('expensecategory') ? 'active' : '' }}" href="{{route('admin.expense-category.index')}}">Expense Category</a></li>
                        <li><a class="{{ Request::is('expensecategory') ? 'active' : '' }}" href="{{route('admin.expense-category.create')}}">Add Expense Category</a></li>

                    </ul>
                </li>
                
                {{-- <li class="submenu">
                    <a class="{{ Request::is('quotationlist','addquotation','editquotation') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/quotation1.svg')}}" alt="img"><span> Quotation</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('quotationlist','editquotation') ? 'active' : '' }}" href="{{url('quotationlist')}}">Quotation List</a></li>
                        <li><a class="{{ Request::is('addquotation') ? 'active' : '' }}" href="{{url('addquotation')}}">Add Quotation</a></li>
                    </ul>
                </li> --}}
                <li class="submenu">
                    <a class="{{ Request::is('admin/transfer/*') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/transfer1.svg')}}" alt="img"><span> Transfer</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/transfer','admin/transfer/edit/*') ? 'active' : '' }}" href="{{route('admin.transfer.index')}}">Transfer  List</a></li>
                        <li><a class="{{ Request::is('admin/transfer/create ') ? 'active' : '' }}" href="{{route('admin.transfer.create')}}">Add Transfer </a></li>
                        <li><a class="{{ Request::is('admin/import-transfer') ? 'active' : '' }}" href="{{route('admin.import-transfer')}}">Import Transfer </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ Request::is('admin/sale/return/*','admin/purchase/return/*') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/return1.svg')}}" alt="img"><span> Return</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('sale/return','sale/return/edit/*') ? 'active' : '' }}" href="{{route('admin.sales.return.index')}}">Sales Return List</a></li>
                        <li><a class="{{ Request::is('admin/sale/return/create') ? 'active' : '' }}" href="{{route('admin.sales.return.create')}}">Add Sales Return </a></li>
                        <li><a class="{{ Request::is('purchase/return','purchase/return/edit/*') ? 'active' : '' }}" href="{{route('admin.purchase.return.index')}}">Purchase Return List</a></li>
                        <li><a class="{{ Request::is('admin/purchase/return/create') ? 'active' : '' }}" href="{{route('admin.purchase.return.create')}}">Add Purchase Return </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ Request::is('admin/customer/*','admin/user/*','admin/store/*','admin/supplier/*') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/users1.svg')}}" alt="img"><span> People</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/customer', 'admin/customer/edit/*') ? 'active' : '' }}" href="{{route('admin.customer.index')}}">Customer List</a></li>
                        <li><a class="{{ Request::is('admin/customer/create') ? 'active' : '' }}" href="{{route('admin.customer.create')}}">Add Customer  </a></li>
                        <li><a class="{{ Request::is('admin/supplier', 'admin/supplier/edit/*') ? 'active' : '' }}" href="{{route('admin.supplier.index')}}">Supplier List</a></li>
                        <li><a class="{{ Request::is('admin/supplier/create') ? 'active' : '' }}" href="{{route('admin.supplier.create')}}">Add Supplier </a></li>
                        <li><a class="{{ Request::is('admin/user', 'admin/user/edit/*') ? 'active' : '' }}" href="{{route('admin.user.index')}}">User List</a></li>
                        <li><a class="{{ Request::is('admin/user/edit') ? 'active' : '' }}" href="{{route('admin.user.create')}}">Add User</a></li>
                        <li><a class="{{ Request::is('admin/store', 'admin/store/edit/*') ? 'active' : '' }}" href="{{route('admin.store.index')}}">Store List</a></li>
                        <li><a class="{{ Request::is('admin/supplier/create') ? 'active' : '' }}" href="{{route('admin.store.create')}}">Add Store</a></li>
                        <li><a class="{{ Request::is('admin/distributor/*') ? 'active' : '' }}" href="{{route('admin.distributor.index')}}">Distributor</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ Request::is('admin/city/*','admin/state/*') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/places.svg')}}" alt="img"><span> Places</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/city','admin/city/*') ? 'active' : '' }}" href="{{route('admin.city.create')}}">New City</a></li>
                        <li><a class="{{ Request::is('admin/city/create') ? 'active' : '' }}" href="{{route('admin.city.index')}}">City list</a></li>
                        <li><a class="{{ Request::is('admin/state','admin/city/edit/*') ? 'active' : '' }}" href="{{route('admin.state.create')}}">New State </a></li>
                        <li><a class="{{ Request::is('admin/state/create') ? 'active' : '' }}" href="{{route('admin.state.index')}}">State list</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a class="{{ Request::is('admin/orders/*','admin/orders/*', 'admin/customer-follow-up/*', 'admin/temp-orders/*') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/places.svg')}}" alt="img"><span> Manage Order</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/orders','admin/orders/*') ? 'active' : '' }}" href="{{route('admin.orders.index')}}">Order</a></li>
                        <li><a class="{{ Request::is('admin/customer-follow-up/*') ? 'active' : '' }}" href="{{route('admin.customer-follow-up.index')}}">Customer Followup</a></li>
                        <li><a class="{{ Request::is('admin/temp-orders/*') ? 'active' : '' }}" href="{{route('admin.temp-orders.index')}}">Temp Order</a></li>

                        
                        
                        
                    </ul>
                </li>
                
                <li class="submenu">
                    <a class="{{ Request::is('purchaseorderreport','inventoryreport','salesreport','invoicereport','purchasereport','supplierreport','customerreport') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/time.svg')}}" alt="img"><span> Report</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('purchaseorderreport') ? 'active' : '' }}" href="{{url('purchaseorderreport')}}">Purchase order report</a></li>
                        <li><a class="{{ Request::is('admin/inventory') ? 'active' : '' }}" href="{{route('admin.inventory.index')}}">Inventory Report</a></li>
                        <li><a class="{{ Request::is('admin/sales-report') ? 'active' : '' }}" href="{{route('admin.sales.report')}}">Sales Report</a></li>
                        {{-- <li><a class="{{ Request::is('invoicereport') ? 'active' : '' }}" href="{{url('invoicereport')}}">Invoice Report</a></li> --}}
                        {{-- <li><a class="{{ Request::is('purchasereport') ? 'active' : '' }}" href="{{route('admin.purchasereport')}}">Purchase Report</a></li> --}}
                        <li><a class="{{ Request::is('supplierreport') ? 'active' : '' }}" href="{{route('admin.supplierreport')}}">Supplier Report</a></li>
                        <li><a class="{{ Request::is('customerreport') ? 'active' : '' }}" href="{{url('customerreport')}}">Customer Report</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ Request::is('admin/banners/*','admin/pages/*') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/users1.svg')}}" alt="img"><span> Ecommerce Setting</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/banners/*') ? 'active' : '' }}" href="{{url('admin/banners')}}">Banner</a></li>
                        <li><a class="{{ Request::is('admin/pages/*') ? 'active' : '' }}" href="{{url('admin/pages')}}">Pages</a></li>
                            
                    </ul>
                </li>

                {{-- <li class="submenu">
                    <a class="{{ Request::is('newuser','userlists','newuseredit') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/users1.svg')}}" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('newuser','newuseredit') ? 'active' : '' }}" href="{{url('newuser')}}">New User </a></li>
                        <li><a class="{{ Request::is('userlists') ? 'active' : '' }}" href="{{url('userlists')}}">Users List</a></li>
                            
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ Request::is('generalsettings','emailsettings','paymentsettings','createpermission','editpermission','currencysettings','grouppermissions','taxrates') ? 'active' : '' }}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/settings.svg')}}" alt="img"><span> Settings</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('generalsettings') ? 'active' : '' }}" href="{{url('generalsettings')}}">General Settings</a></li>
                        <li><a class="{{ Request::is('emailsettings') ? 'active' : '' }}" href="{{url('emailsettings')}}">Email Settings</a></li>
                            
                        <li><a class="{{ Request::is('paymentsettings') ? 'active' : '' }}" href="{{url('paymentsettings')}}">Payment Settings</a></li>
                        <li><a class="{{ Request::is('currencysettings') ? 'active' : '' }}" href="{{url('currencysettings')}}">Currency Settings</a></li>
                        <li><a class="{{ Request::is('grouppermissions','editpermission','createpermission') ? 'active' : '' }}" href="{{url('grouppermissions')}}">Group Permissions</a></li>
                        <li><a class="{{ Request::is('taxrates') ? 'active' : '' }}" href="{{url('taxrates')}}">Tax Rates</a></li>
                    </ul>
                </li> --}}
            </ul>
            @endif 
           
        </div>
    </div>
</div>
<!-- /Sidebar -->
