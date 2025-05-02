<div class="main_header">  
 <div class="header">
        <div class="header-left">
          <img src="{{asset('asset/images/YuwaahLogocolo.png')}}" alt="LogoImage" class="logoimageclass">
          <div class="nav">
            <a class="{{ request()->routeIs('partnercenter.dashboard') ? 'active' : '' }}"   href="{{route('partnercenter.dashboard')}}">Performance</a>
            <a  class="{{ request()->routeIs('partnercenter.promotional') ? 'active' : '' }}"  href="{{route('partnercenter.promotional')}}">Promotions</a>
            <a class="
            {{ request()->routeIs('partnercenter.opportunites') ? 'active' : '' }}
            {{ request()->routeIs('partnercenter.opportunites.details') ? 'active' : '' }}
            
            "  href="{{route('partnercenter.opportunites')}}">Opportunities</a>
            <a class="{{ request()->routeIs('partnercenter.event') ? 'active' : '' }}"  href="{{route('partnercenter.event')}}">Event</a>
          </div>
        </div>
    
        <!-- Wrapper for Icons and Hamburger -->
        <div class="header-right">
        <div class="stat-label">
          <p>{{ucwords(Auth::user()->center_name)}}&nbsp;|&nbsp;{{ucwords(Auth::user()->email)}}</p>
        </div>
          <!-- Desktop Icons -->
          <div class="icons">
            <!-- <img src="{{asset('asset/images/Notifications.png')}}" alt=""> -->
            <img src="{{asset('asset/images/Profile.png')}}" alt="" id="profilePic" class="profile-pic">
            <div id="menu" class="menu">
              <ul>
              <li class="info-item"><a href="{{route('partnercenter.setting')}}">View Profile</a></li>
              <li class="info-item"><a href="{{route('partnercenter.setting')}}">Settings</a></li>
                  <li><form method="POST" action="{{ route('partnercenter.logout') }}">
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