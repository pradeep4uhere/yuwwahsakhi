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
          <!-- Desktop Icons -->
          <div class="icons">
            <img src="{{asset('asset/images/Notifications.png')}}" alt="">
            <img src="{{asset('asset/images/Profile.png')}}" alt="">
          </div>
    
          <!-- Hamburger Icon for Mobile -->
          <button class="hamburger" id="hamburger-btn">
            <i class="fas fa-bars"></i>
          </button>
        </div>
    </div>
</div>