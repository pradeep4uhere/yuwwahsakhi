
<div class="main_header">  
 <div class="header">
        <div class="header-left">
          <img src="{{asset('asset/images/YuwaahLogocolo.png')}}" alt="LogoImage" class="logoimageclass" width="100px" height="70px">
          <div class="nav">
            <a class="{{ request()->routeIs('placementpartner.dashboard') ? 'active' : '' }}"   href="{{route('placementpartner.dashboard')}}">Dashboard</a>
            <a class="
            {{ request()->routeIs('placementpartner.viewyuwaahsakhi') ? 'active' : '' }}
            {{ request()->routeIs('placementpartner.viewyuwaahsakhi') ? 'active' : '' }}" 
             href="{{route('placementpartner.viewyuwaahsakhi')}}">Field Agents</a>
            <!-- <a class="{{ request()->routeIs('partner.event') ? 'active' : '' }}"  href="{{route('partner.event')}}">Event Transactions</a> -->
          </div>
        </div>
    
        <!-- Wrapper for Icons and Hamburger -->
        <div class="header-right" style="width:400px">
       
        <div class="stat-label">
          <p>{{ucwords(Auth::user()->name)}}&nbsp;|&nbsp;{{ucwords(Auth::user()->email)}}</p>
       
        </div>
          <!-- Desktop Icons -->
          <div class="icons">
            <!-- <img src="{{asset('asset/images/Notifications.png')}}" alt=""> -->
            <img src="{{asset('asset/images/Profile.png')}}" alt="" id="profilePic" class="profile-pic">
            <div id="menu" class="menu">
              <ul >
                  <li class="info-item"><a href="{{route('partner.setting')}}">View Profile</a></li>
                  <li class="info-item"><a href="{{route('partner.setting')}}">Settings</a></li>
                  <li class="info-item"><form method="POST" action="{{ route('partner.logout') }}">
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
          </div>
    
          <!-- Hamburger Icon for Mobile -->
          <button class="hamburger" id="hamburger-btn">
            <i class="fas fa-bars"></i>
          </button>
        </div>
    </div>
</div>