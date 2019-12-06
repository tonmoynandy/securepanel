<ul class="navbar ">
        <a class="nav-item" href="{{ \URL::route('secure_dashboard') }}" title="Home" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-home"></i> </a>
        <a class="nav-item" href="{{ \URL::route('secure_profile') }}" title="Profile" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-user-circle"></i></a>
        <a class="nav-item" href="{{ \URL::route('secure_logout') }}" title="Logout" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-sign-out"></i></a>
  </ul>
<div class="menu-content">

    <ul>
        <li>
            <a href="javascript:void(0);" title="User Management" data-toggle="tooltip" data-placement="right"><i class="fa fa-users"></i><span>Users</span></a>
        </li>
      
        <li>
            <a href="{{ route('secure_country_list') }}" class="{{ request()->is('country/list') ? 'active' : '' }}" title="Country" data-toggle="tooltip" data-placement="right"><i class="fa fa-map"></i><span>Countries</span></a>
        </li>
        <li>
            <a href="{{ route('secure_state_list') }}" class="{{ request()->is('state/list') ? 'active' : '' }}" title="State" data-toggle="tooltip" data-placement="right"><i class="fa fa-map"></i><span>States</span></a>
        </li>
        <li>
            <a href="{{ route('secure_city_list') }}" class="{{ request()->is('city/list') ? 'active' : '' }}" title="City" data-toggle="tooltip" data-placement="right"><i class="fa fa-map"></i><span>Cities</span></a>
        </li>
        <li>
            <a href="{{ route('secure_cms_list') }}" class="{{ request()->is('cms/list','cms/edit/*') ? 'active' : '' }}" title="Cms List" data-toggle="tooltip" data-placement="right"><i class="fa fa-leaf"></i><span>CMS</span></a>
        </li>
       
       
        <li>
            <a href="{{ route('secure_settings_list') }}" class="{{ request()->is('site-settings/list') ? 'active' : '' }}" title="Site settings" data-toggle="tooltip" data-placement="right"><i class="fa fa-cogs"></i><span>Site Settings</span></a>
        </li>
      

    </ul>
    
</div>