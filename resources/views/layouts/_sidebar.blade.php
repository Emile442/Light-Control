<div class="sidebar" data-color="orange">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="{{ route('root') }}" class="simple-text logo-mini">
            Epi
        </a>
        <a href="{{ route('root') }}" class="simple-text logo-normal">
            {{ env('APP_NAME') }}
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ route('root') }}">
                    <i class="now-ui-icons objects_spaceship"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{ Request::is('groups') ? 'active' : '' }} {{ Request::is('groups/*') ? 'active' : '' }}">
                <a href="{{ route('groups.index') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>Groups</p>
                </a>
            </li>
            <li class="{{ Request::is('lights') ? 'active' : '' }} {{ Request::is('lights/*') ? 'active' : '' }}">
                <a href="{{ route('lights.index') }}">
                    <i class="now-ui-icons business_bulb-63"></i>
                    <p>Lights</p>
                </a>
            </li>
            <li class="{{ Request::is('network') ? 'active' : '' }}">
                <a href="{{ route('network.index') }}">
                    <i class="now-ui-icons design_vector"></i>
                    <p>Network</p>
                </a>
            </li>
        </ul>
    </div>
</div>
