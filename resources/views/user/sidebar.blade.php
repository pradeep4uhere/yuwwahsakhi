
<!-- Sidebar Overlay -->
<div id="sidebarOverlay" class="sidebar-overlay hidden" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside id="appSidebar" class="premium-sidebar">
    <div class="sidebar-top">
        <div class="sidebar-brand-row">
            <div class="sidebar-brand">
                <img src="{{ asset('asset/images/Yuwaahlogo.png') }}" alt="YuWaah Logo">
                <div>
                    <h3>Youthhubpartner</h3>
                    <p>Partner App</p>
                </div>
            </div>

            <button type="button" class="sidebar-close-btn" onclick="toggleSidebar()">
                &times;
            </button>
        </div>

        <div class="sidebar-user-card">
            <div class="sidebar-user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }} 
            </div>

            <div class="sidebar-user-info">
                <h4>{{ auth()->user()->name ?? 'User' }}</h4>
                <p>{{getYuwaahSakhiAuthID()}} &nbsp;|&nbsp; {{ auth()->user()->contact_number ?? 'User' }}</p>
            </div>
        </div>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('dashboard') }}"
           class="sidebar-menu-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
            <span class="sidebar-menu-icon">🏠</span>
            <span>{{ __('messages.dashboard') }}</span>
        </a>

        <a href="{{ route('user.allevents') }}"
           class="sidebar-menu-item {{ Route::currentRouteName() == 'user.allevents' ? 'active' : '' }}">
            <span class="sidebar-menu-icon">📄</span>
            <span>{{ __('messages.all_events') }}</span>
        </a>

        <a href="{{ route('upload') }}"
           class="sidebar-menu-item {{ Route::currentRouteName() == 'upload' ? 'active' : '' }}">
            <span class="sidebar-menu-icon">➕</span>
            <span>{{ __('messages.add_event') }}</span>
        </a>

        <a href="{{ route('opportunities', ['filter' => 'desc', 'order_by' => 'id']) }}"
           class="sidebar-menu-item {{ Route::currentRouteName() == 'opportunities' ? 'active' : '' }}">
            <span class="sidebar-menu-icon">⭐</span>
            <span>{{ __('messages.opportunities') }}</span>
        </a>

        <a href="{{ route('learner') }}"
           class="sidebar-menu-item {{ Route::currentRouteName() == 'learner' ? 'active' : '' }}">
            <span class="sidebar-menu-icon">👥</span>
            <span>{{ __('messages.learners') }}</span>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="sidebar-menu-item {{ Route::currentRouteName() == 'profile.edit' ? 'active' : '' }}">
            <span class="sidebar-menu-icon">⚙️</span>
            <span>{{ __('messages.profile') }}</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout-btn">
                <span>🚪</span>
                <span>{{ __('messages.logout') }}</span>
            </button>
        </form>
    </div>
</aside>
