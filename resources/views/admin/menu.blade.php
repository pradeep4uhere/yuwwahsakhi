<div class="hamburger" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <nav id="navMenu">
        <div class="close-menu" onclick="toggleMenu()">&times;</div>
        <div class="logo-name">
            <div class="logo-image">
                <img src="{{asset('asset/images/YuwaahLogocolo.png')}}" alt="LogoImage" class="logoimageclass">
            </div>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <span class="dashmobile" style="font-weight:600; font-size: 20px; line-height: 24.38px;">Dashboard</span>
                <li style="margin-top: 1rem;" class="{{ request()->is('admin/overview') ? 'activelink' : '' }}">
                    <a href="overview.html" id="overview-link">
                        <i class="uil uil-files-landscapes {{ request()->is('admin/overview') ? 'activelink' : '' }}"></i>
                        <span class="link-name {{ request()->is('admin/overview') ? 'activelink' : '' }}">Overview</span>
                    </a></li>
                <li class="{{ request()->routeIs('admin.partner') ? 'activelink' : '' }}">
                    <a href="{{route('admin.partner')}}" id="partners-link" >
                        <i class="uil uil-users-alt 
                            {{ request()->routeIs('admin.partner') ? 'activelinktext' : '' }} 
                            {{ request()->routeIs('admin.partner.edit') ? 'activelinktext' : '' }}
                            {{ request()->routeIs('admin.partner.add') ? 'activelinktext' : '' }}
                        "></i>
                        <span class="link-name 
                            {{ request()->routeIs('admin.partner') ? 'activelinktext' : '' }} 
                            {{ request()->routeIs('admin.partner.edit') ? 'activelinktext' : '' }}
                            {{ request()->routeIs('admin.partner.add') ? 'activelinktext' : '' }}
                        ">Partners</span>
                    </a></li>
                <li class="{{ request()->routeIs('admin.partnercenter') ? 'activelink' : '' }}">
                    <a href="{{route('admin.partnercenter')}}" id="partners-link" >
                        <i class="uil uil-users-alt 
                        {{ request()->routeIs('admin.partnercenter.edit') ? 'activelinktext' : '' }} 
                        {{ request()->routeIs('admin.partnercenter') ? 'activelinktext' : '' }}
                        {{ request()->routeIs('admin.partnercenter.add') ? 'activelinktext' : '' }}
                        
                        "></i>
                        <span class="link-name 
                         {{ request()->routeIs('admin.partnercenter.edit') ? 'activelinktext' : '' }} 
                         {{ request()->routeIs('admin.partnercenter') ? 'activelinktext' : '' }}
                         {{ request()->routeIs('admin.partnercenter.add') ? 'activelinktext' : '' }}  
                        ">Partner Center</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.yuwaahsakhi') ? 'activelink' : '' }}">
                    <a href="{{route('admin.yuwaahsakhi.list')}}" id="partners-link" >
                        <i class="uil uil-users-alt 
                        {{ request()->routeIs('admin.yuwaahsakhi.update') ? 'activelinktext' : '' }} 
                        {{ request()->routeIs('admin.yuwaahsakhi.list') ? 'activelinktext' : '' }}
                        {{ request()->routeIs('admin.yuwaahsakhi.add') ? 'activelinktext' : '' }}
                        
                        "></i>
                        <span class="link-name 
                         {{ request()->routeIs('admin.yuwaahsakhi.update') ? 'activelinktext' : '' }} 
                         {{ request()->routeIs('admin.yuwaahsakhi.list') ? 'activelinktext' : '' }}
                         {{ request()->routeIs('admin.yuwaahsakhi.add') ? 'activelinktext' : '' }}  
                        ">Yuwaah Sakhi</span>
                    </a>
                </li>
                
               

                <li class="{{ request()->is('opportunities') ? 'activelink' : '' }}">
                    <a href="{{route('admin.opportunities.list')}}" id="opportunities-link">
                        <i class="uil uil-lightbulb-alt 
                        {{ request()->routeIs('admin.opportunities.list') ? 'activelinktext' : '' }} 
                        {{ request()->routeIs('admin.opportunities.update') ? 'activelinktext' : '' }}
                        {{ request()->routeIs('admin.opportunities.add') ? 'activelinktext' : '' }}
                          
                        "></i>
                        <span class="link-name 
                            {{ request()->routeIs('admin.opportunities.list') ? 'activelinktext' : '' }} 
                            {{ request()->routeIs('admin.opportunities.update') ? 'activelinktext' : '' }}
                            {{ request()->routeIs('admin.opportunities.add') ? 'activelinktext' : '' }}
                           ">Opportunities</span>
                    </a></li>
                <li class="{{ request()->is('promotions') ? 'activelink' : '' }}">                    
                    <a href="{{route('admin.promotions.list')}}" id="promotion-link">
                        <i class="il uil-megaphone
                            {{ request()->routeIs('admin.promotions.list') ? 'activelinktext' : '' }} 
                            {{ request()->routeIs('admin.promotions.update') ? 'activelinktext' : '' }}
                            {{ request()->routeIs('admin.promotions.add') ? 'activelinktext' : '' }}

                            "></i>
                        <span class="link-name
                            {{ request()->routeIs('admin.promotions.list') ? 'activelinktext' : '' }} 
                            {{ request()->routeIs('admin.promotions.update') ? 'activelinktext' : '' }}
                            {{ request()->routeIs('admin.promotions.add') ? 'activelinktext' : '' }}
                            ">Promotions</span>
                    </a></li>
                <li><a href="promotions.html" id="promotion-link">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="route('admin.logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    <i class="il uil-megaphone"></i>
                    <span class="link-name">SignOut</span>
                    </a>
                    </form>
                </a></li>
                   
                           
                        
            </ul>
            <ul class="logout-mode">
                <li>
                    <div class="user-info">
                        <img src="{{asset('asset/images/Profilelogo.png')}}" alt="User Image" class="user-image">
                        <div class="user-details">
                            <span class="user-name">{{Auth::guard('admin')->user()->name}}</span>
                            <span class="user-email">{{Auth::guard('admin')->user()->email}}</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>