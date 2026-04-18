<div class="app-header-wrap">
    <header class="premium-mobile-header">

        <div class="header-left">
            @if(
                (Route::currentRouteName() == 'profile.edit') || 
                (Route::currentRouteName() == 'addopportunities') ||
                (Route::currentRouteName() == 'opportunitiesLearner') ||
                (Route::currentRouteName() == 'user.allevents')
            )
                <a href="{{ route('dashboard') }}" class="header-action-btn back-btn">
                    <img src="{{ asset('asset/images/arrow-left.png') }}" alt="Back">
                </a>
            @else
            <button type="button" id="hamburger" class="header-action-btn menu-btn" onclick="toggleSidebar()">
    <span></span>
    <span></span>
    <span></span>
</button>
            @endif
        </div>

        <div class="header-center">
            <a href="{{ route('dashboard') }}" class="header-logo-link">
                <img src="{{ asset('asset/images/Yuwaahlogo.png') }}" alt="YuWaah Logo" class="header-logo">
            </a>
        </div>

        <div class="header-right">
            <button type="button" class="header-action-btn" onclick="toggleLanguageForm()">
                <img src="{{ asset('asset/images/eng.png') }}" alt="Language" class="header-icon-img">
            </button>

            <button type="button" class="header-action-btn notification-btn">
                <i class="material-icons">notifications_none</i>
            </button>
        </div>
    </header>

    @if(auth()->check())
        @include('user.sidebar')
    @endif
</div>

<!-- Language Modal -->
<div id="languageForm" class="language-modal-overlay hidden">
    <div class="language-modal-card">
        <div class="language-modal-header">
            <h3>{{ __('messages.select') }} {{ __('messages.language') }}</h3>
            <button type="button" class="language-close-btn" onclick="toggleLanguageForm()">&times;</button>
        </div>

        <form action="{{ route('change.language') }}" method="POST">
            @csrf

            <div class="language-form-group">
                <label for="language">{{ __('messages.language') }}</label>

                <select name="language" id="language" class="language-select">
                    <option value="" disabled selected>{{ __('messages.Please_Select_Language') }}</option>
                    <option value="en">{{ __('messages.english') }}</option>
                    <option value="hi">{{ __('messages.hindi') }}</option>
                </select>
            </div>

            <button type="submit" class="language-submit-btn">
                {{ __('messages.apply') }}
            </button>
        </form>
    </div>
</div>