
<div class="main_header">  
 <div class="header">
        <div class="header-left">
          <img src="{{asset('asset/images/YuwaahLogocolo.png')}}" alt="LogoImage" class="logoimageclass">
          <div class="nav">
            <a class="{{ request()->routeIs('partner.dashboard') ? 'active' : '' }}"   href="{{route('partner.dashboard')}}">Performance</a>
            <a class="
            {{ request()->routeIs('partner.partnercenter') ? 'active' : '' }}
            {{ request()->routeIs('partner.partnercenter.viewyuwaahsakhi') ? 'active' : '' }}" 
             href="{{route('partner.partnercenter')}}">Partner Center Details</a>
            <a  class="{{ request()->routeIs('partner.promotional') ? 'active' : '' }}"  href="{{route('partner.promotional')}}">Promotions</a>
            <a class="
            {{ request()->routeIs('partner.opportunites') ? 'active' : '' }}
            {{ request()->routeIs('partner.opportunites.details') ? 'active' : '' }}
            
            "  href="{{route('partner.opportunites')}}">Opportunities</a>
            <a class="{{ request()->routeIs('partner.event') ? 'active' : '' }}"  href="{{route('partner.event')}}">Event</a>
          </div>
        </div>
    
        <!-- Wrapper for Icons and Hamburger -->
        <div class="header-right">
          <p>{{Auth::user()->name}}</p>
          <!-- Desktop Icons -->
          <div class="icons">
            <img src="{{asset('asset/images/Notifications.png')}}" alt="">
            <img src="{{asset('asset/images/Profile.png')}}" alt="" id="profilePic" class="profile-pic">
            <div id="menu" class="menu">
              <ul>
                  <li><a href="#">View Profile</a></li>
                  <li><a href="#">Settings</a></li>
                  <li><form method="POST" action="{{ route('partner.logout') }}">
                    @csrf
                    <a href="route('admin.logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    <i class="il uil-megaphone"></i>
                    <span class="link-name">Sign Out</span>
                    </a>
                    </form></li>
              </ul>
          </div>
          </div>
    
          <!-- Hamburger Icon for Mobile -->
          <button class="hamburger" id="hamburger-btn">
            <i class="fas fa-bars"></i>
          </button>
        </div>
    </div>
</div>