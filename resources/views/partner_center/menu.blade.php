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
          <!-- Desktop Icons -->
          <div class="icons">
            <img src="{{asset('asset/Images/Notifications.png')}}" alt="">
            <img src="{{asset('asset/Images/Profile.png')}}" alt="">
          </div>
    
          <!-- Hamburger Icon for Mobile -->
          <button class="hamburger" id="hamburger-btn">
            <i class="fas fa-bars"></i>
          </button>
        </div>
    </div>
</div>