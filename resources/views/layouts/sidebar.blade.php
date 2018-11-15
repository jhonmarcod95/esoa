<div class="sidebar" data-color="blue" data-image="{{ asset('assets/img/sidebar-4.jpg') }}">
<!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ url('/') }}" class="simple-text">
                <img class="rounded-circle" src="{{ asset('assets/img/logo.jpg') }}" style="width: 40px; height: auto"/>
                E-SOA Portal
            </a>
        </div>

        <ul class="nav">

            @role('user')
            @if(session('account'))
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/history') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Statement History</p>
                </a>
            </li>
            @endif
            @endrole

            @role('user')
            @if(!session('account'))
            <li>
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="nc-icon nc-badge"></i>
                    <p>Accounts</p>
                </a>
            </li>
            @endif
            @endrole

            @role('admin|viewer')
            <li>
                <a class="nav-link" href="{{ url('/log') }}">
                    <i class="nc-icon nc-watch-time"></i>
                    <p>Logs</p>
                </a>
            </li>
            @endrole

            @role('admin')
            <li>
                <a class="nav-link" href="{{ url('/users') }}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>User Master</p>
                </a>
            </li>
            @endrole

            <li>
                <a class="nav-link" href="{{ url('/userprofile') }}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>User Profile</p>
                </a>
            </li>

            @role('admin|viewer')
            <li>
                <a class="nav-link" href="{{ url('/log-history') }}">
                    <i class="nc-icon nc-watch-time"></i>
                    <p>Log History</p>
                </a>
            </li>
            @endrole

            <li class="nav-item active active-pro">
                <a class="nav-link active" href="{{ asset('manuals/how_tos.pdf') }}" target="_blank">
                    <i class="nc-icon"></i>
                    <p>User's Manual</p>
                </a>

                @if(session('account'))
                <a class="nav-link" href="{{ url('/account/switch') }}">
                    <p>Switch Account</p>
                </a>
                @endif

                <a class="nav-link active" href="{{ session('about_us') }}" target="_blank">
                    <i class="nc-icon"></i>
                    <p>About Us</p>
                </a>
            </li>



        </ul>
    </div>
</div>