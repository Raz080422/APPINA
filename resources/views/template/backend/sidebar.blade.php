

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <img alt="image" class="rounded-circle" src="{{ asset('assets/img/profile_small.jpg') }}" />
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="block m-t-xs font-bold">{{ Session::get('name') }}</span> <span class="text-muted text-xs block">{{ Session::get('jabatan') }} <b class="caret"></b></span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element"> IN+ </div>
            </li>
            @php
                $menu = Session::get('menu_user');
            @endphp

            @if(count($menu) > 0)
                @foreach($menu as $rowMenu)
                    @if($rowMenu['szType'] == 'M')
                        @if($rowMenu['szMenuName'] == 'Dashboard')
                            <li class="{{ (Session::get('trancode') == $rowMenu['szMenuId']) ? 'active' : '' }}">
                                <a href="{{ url('/') }}">
                                    <i class="fa fa-th-large"></i> 
                                    <span class="nav-label">Dashboard</span>
                                </a>
                            </li>
                        @else
                            <li id="{{ $rowMenu['szMenuId'] }}">
                                <a href="{{ url('/') }}">
                                    <i class="fa fa-pie-chart"></i> 
                                    <span class="nav-label">{{ $rowMenu['szMenuName'] }}</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level {{ (Session::get('szGroupId') == $rowMenu['szMenuId']) ? 'nav nav-second-level collapse in' : 'nav nav-second-level' }}">
                                    @foreach($menu as $rowSubmenu)
                                        @if($rowSubmenu['szType'] == 'S' && $rowSubmenu['szGroupId'] == $rowMenu['szGroupId'])
                                            <li class="{{ (Session::get('szTrancode') == $rowSubmenu['szTrancode']) ? 'active' : '' }}">
                                                <a href="{{ url('/'). $rowSubmenu['szLink'] }}">
                                                    <span class="nav-label">{{ $rowSubmenu['szMenuName'] }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</nav>
@push('script')
<script>
    $(function(){
        $('#2').click();
    });
</script>
@endpush