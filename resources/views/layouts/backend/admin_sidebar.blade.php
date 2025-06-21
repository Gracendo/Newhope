<!-- Menu Navigation starts -->
    <nav>
      <div class="app-logo">
        <a class="logo d-inline-block" href="index.html" >
           <div style="display:flex;align-items:center">
            <img src="{{asset('assets/frontend/images/loader.svg')}}" style="width:55px" alt="Logo" ><span  style="margin-left:10px;color :#FF6600; font-size:60"> Newhope </span>
           </div>
          
        </a>

        <span class="bg-light-primary toggle-semi-nav">
          <i class="ti ti-chevrons-right f-s-20"></i>
        </span>
      </div>
      <div class="app-nav" id="app-simple-bar">
        <ul class="main-nav p-0 mt-2">
          <li class="no-sub">
            <a class=""  href="{{route('admin.home')}}" onclick="window.location.href='{{ route('admin.home') }}'; return false;">
              <i class="ph-duotone  ph-house-line"></i>
              dashboard
              <!-- <span class="badge text-bg-success badge-notification ms-2">4</span> -->
            </a>
          </li>
           <li class="menu-title"> <span>Campaign Management</span></li>

          <li class="no-sub">
            <a class="" href="{{route('admin.campaign')}}" onclick="window.location.href='{{ route('admin.campaign') }}'; return false;">
              <i class="ph-duotone  ph-stack"></i>
              Campaigns
            </a>
          </li>
          @canany(['user-list','user-create'])
            <li class="menu-title"> <span>User Management</span></li>
            <li class="no-sub">
              <a class="" href="{{route('admin.manageUsers')}}" onclick="window.location.href='{{ route('admin.manageUsers') }}'; return false;">
                <i class="fa-solid fa-user fa-fw"></i>  All users
              </a>
            </li>
          @endcanany
          
          <li class="no-sub">
            <a class=""href="{{route('admin.profilePersonalInfo')}}" onclick="window.location.href='{{ route('admin.profilePersonalInfo') }}'; return false;">
              <i class="fa-solid fa-user fa-fw"></i>  My profile
            </a>
          </li>
         

          

        </ul>
      </div>

      <div class="menu-navs">
        <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
        <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
      </div>

    </nav>
    <!-- Menu Navigation ends -->