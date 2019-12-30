
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('admin_image/logo.png')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p style="color: white;">NEA</p>

      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">HEADER</li>
      <!-- Optionally, you can add icons to the links -->
      <li><a href="{{url('/')}}" class="newtab"><i class="fa fa-home text-orange"></i> <span style="color: orange;">गृहपृष्ट </span></a></li>

      <!--======== Expenditure Voucher ==========-->
      <li class="treeview  {{Request::is('/customers/getVauchers')?'active':''}}{{Request::is('/customers/myVauchers')?'active':''}}">
        <a href="#">
          <i class="fa fa-folder-open"></i>
          <span>खर्च भौचर विवरण</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="">
          <li class="{{Request::is('customers/getVauchers')?'active':''}}"><a href="{{url('/customers/getVauchers')}}" class="newtab"><i class="fa fa-file"></i>जम्मा खर्च भौचर</a></li>

          <li class="{{Request::is('/customers/myVauchers')?'active':''}}"><a href="{{url('/customers/myVauchers')}}" class="newtab"><i class="fa fa-file"></i>मेरो खर्च भौचर </a></li>

        </ul>
      </li>
      <!--======== Expenditure Voucher ==========-->


      <!--======== Customer Details ==========-->
      <li class="treeview  {{Request::is('customers/pendingCustomer')?'active':''}}  {{Request::is('customers/completedCustomer')?'active':''}} {{Request::is('customers/rejetedCustomer')?'active':''}} {{Request::is('customer/create')?'active':''}}{{Request::is('customers/returnCustomer')?'active':''}}{{Request::is('customers/doneCustomer')?'active':''}}">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>ग्राहक विवरण </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="">

          <li class="{{Request::is('customer/create')?'active':''}}"><a href="{{url('/customer/create')}}" class="newtab"><i class="fa fa-plus-circle text-green"></i>नयाँ ग्राहक दर्ता </a></li>

          <li class="{{Request::is('customers/pendingCustomer')?'active':''}}"><a href="{{url('/customers/pendingCustomer')}}" class="newtab"><i class="fa fa-check-circle text-yellow"></i>नयाँ ग्राहक विवरण</a></li>
          <li class="{{Request::is('customers/returnCustomer')?'active':''}}"><a href="{{url('/customers/returnCustomer')}}" class="newtab"><i class="fa fa-check-circle text-yellow"></i>फिर्ता ग्राहक विवरण</a></li>
          <li class="{{Request::is('customers/doneCustomer')?'active':''}}"><a href="{{url('/customers/doneCustomer')}}" class="newtab"><i class="fa fa-check-circle text-yellow"></i>सम्पन्न ग्राहक विवरण </a></li>
          <li class="{{Request::is('customers/completedCustomer')?'active':''}}"><a href="{{url('/customers/completedCustomer')}}" class="newtab"><i class="fa fa-check-circle text-yellow"></i>मिटर प्राप्त ग्राहक विवरण</a></li>
          <li class="{{Request::is('customers/rejetedCustomer')?'active':''}}" class="newtab"><a href="{{url('/customers/rejetedCustomer')}}"><i class="fa fa-times-circle text-red"></i>रद्द ग्राहक विवरण </a></li>

        </ul>
      </li>
      <!--======== Customer Details ==========-->


      <!--======== Meter Stock ==========-->
      <li class="treeview  {{Request::is('meter')?'active':''}} {{Request::is('meter/getAvailableMeter')?'active':''}} {{Request::is('meter/getAssignedMeter')?'active':''}}{{Request::is('meter/all')?'active':''}}{{Request::is('meter/create')?'active':''}}
          ">
        <a href="#">
          <i class="fa fa-bolt"></i>
          <span>मिटर मौजदात</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="">

          <li class="{{Request::is('meter/create')?'active':''}}"><a href="{{url('/meter/create')}}" class="newtab"><i class="fa fa-plus-circle text-green"></i> मिटर मौजदात दर्ता </a></li>

          <li class="{{Request::is('meter/getAvailableMeter')?'active':''}}"><a href="{{url('/meter/getAvailableMeter')}}" class="newtab"><i class="fa fa-check-circle text-yellow"></i> मिटर मौजदात विवरण</a></li>


          <li class="{{Request::is('meter/getAssignedMeter')?'active':''}}"><a href="{{url('/meter/getAssignedMeter')}}" class="newtab"><i class="fa fa-check-circle text-yellow"></i> <span>जारी गरिएका मिटर </span></a></li>

          <li class="{{Request::is('meter')?'active':''}}"><a href="{{url('/meter')}}"><i class="fa fa-check-circle text-yellow"></i> <span>मेरो मिटर दर्ता </span></a></li>
        </ul>
      </li>
      <!--======== Meter Stock ==========-->


<!-- ========= meter reconciliation Report start ============= -->
         <li class="{{Request::is('reconciliation')?'active':''}}"><a href="{{route('reconciliation.index')}}" class="newtab"><i class="fa fa-book"></i> <span>हिसाव मिलान रिपोर्ट</span></a></li>
<!-- ====== meter reconciliation Report End ============ -->


      <!--======== Retunr Meter ==========-->
      <li class="{{Request::is('meter/returnmeter')?'active':''}}  "><a href="{{url('/meter/returnmeter')}}" class="newtab"><i class="fa fa-undo"></i> <span>मिटर फिर्ता </span></a></li>
      <!-- ============= Return Meter ===========-->

      <!--=========== Registratiom Book========== -->
      <li class="treeview {{Request::is('registration')?'active':''}} {{Request::is('registration/create')?'active':''}} {{Request::is('registrations/freelist')?'active':''}}">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>दर्ता किताव</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="">
          <li class="{{Request::is('registration/create')?'active':''}}"><a href="{{route('registration.create')}}" class="newtab"><i class="fa fa-plus-circle text-green"></i> नयाँ दर्ता </a></li>

          <li class="{{Request::is('registration')?'active':''}}"><a href="{{route('registration.index')}}" class="newtab"><i class="fa fa-check-circle text-yellow"></i>स-शुल्क दर्ता </a></li>

          <li class="{{Request::is('registrations/freelist')?'active':''}}"><a href="{{route('registration.freelist')}}" class="newtab"><i class="fa fa-check-circle text-yellow"></i> नि:शुल्क दर्ता </a></li>
        </ul>
      </li>

      <!--=========== Registratiom Book========== -->




      <!--=========== Customer Category========== -->
      <li class="{{Request::is('customer_category')?'active':''}}"><a href="{{route('customer_category.index')}}"><i class="fa fa-users"></i> <span>ग्राहक वर्गीकरण </span></a></li>
      <!--=========== Customer Category========== -->

      <!--=========== Receiver Persion========== -->
      <li class="{{Request::is('receivers')?'active':''}}"><a href="{{route('receivers.index')}}"><i class="fa fa-user"></i> <span>बुझिलिने व्यक्ति </span></a></li>
      <!--=========== Receiver Person========== -->

      <!--========= Setting Start========= -->
      <li class="treeview  {{Request::is('backups')?'active':''}}  {{Request::is('accounts')?'active':''}}
          ">
        <a href="#">
          <i class="fa fa-gear"></i>
          <span>Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="">

          <li class="{{Request::is('accounts')?'active':''}}"><a href="{{route('accounts.index')}}" class="newtab"><i class="fa fa-user"></i> <span>Admin</span></a></li>

          <li class="{{Request::is('backups') ?'active':''}}"><a href="{{route('backups.index')}}" class="newtab"><i class="fa fa-upload"></i> Backups</a></li>

          <li class="{{Request::is('settings/email') ?'active':''}}"><a href="{{route('settings.email')}}" class="newtab"><i class="fa fa-envelope"></i>Set Email</a></li>
        </ul>
      </li>
      <!--========= Setting End========= -->

      <!--========= Trace End========= -->
      <li class="treeview  {{Request::is('meter/trash')?'active':''}} {{Request::is('customers/trash')?'active':''}}
          ">
        <a href="#">
          <i class="fa fa-trash"></i>
          <span>Trash</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="">

          <li class="{{Request::is('meter/trash')?'active':''}}"><a href="{{route('meter.trash')}}"><i class="fa fa-bolt" class="newtab"></i> <span>Meters</span></a></li>

          <li class="{{Request::is('customers/trash')?'active':''}}"><a href="{{route('customer.trash')}}" class="newtab"><i class="fa fa-users"></i> <span>Customers</span></a></li>

        </ul>
      </li>
      <!--========= Trace End========= -->

      <!-- =========Logout start ==========-->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <i class="fa fa-circle-o text-red"></i>
          {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
      <!--======== Logout start=========== -->


    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>