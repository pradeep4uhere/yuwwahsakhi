@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<style>
  .mobile-app-shell {
    width: 100%;
    max-width: 430px;
    margin: 0 auto;
    min-height: 100vh;
    background: linear-gradient(180deg, #f8fbff 0%, #edf3fa 100%);
    box-shadow: 0 12px 40px rgba(15, 23, 42, 0.10);
    position: relative;
    overflow: visible;
}

.app-body {
    padding: 16px 14px 110px;
}

.page-section {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.page-toolbar-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 16px;
    box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
    border: 1px solid #e5edf8;
}

.page-toolbar-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}

.page-title {
    font-size: 16px;
    font-weight: 800;
    color: #111827;
    margin: 0;
}

.page-count {
    color: #2563eb;
}

.action-btn {
    border: none;
    border-radius: 14px;
    min-height: 38px;
    padding: 9px 14px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.25s ease;
}

.action-btn-soft {
    background: #eef4ff;
    color: #28388f;
    border: 1px solid #cdddff;
}

.info-strip {
    background: #fffaf0;
    border: 1px solid #fde7c7;
    border-radius: 16px;
    padding: 12px 14px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px 14px;
    align-items: center;
    box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
}

.info-strip-secondary {
    background: #ffffff;
    border: 1px solid #e5edf8;
    justify-content: space-between;
    font-size: 11px;
    font-weight: 600;
    color: #344054;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

.legend-label {
    font-size: 11px;
    font-weight: 700;
}

.legend-label.warning { color: #b45309; }
.legend-label.submitted { color: #2563eb; }
.legend-label.accepted { color: #15803d; }
.legend-label.rejected { color: #b91c1c; }

.dot {
    display: inline-block;
    border-radius: 999px;
}

.dot.large {
    width: 18px;
    height: 18px;
}

.dot.blue { background: #3b82f6; }
.dot.green { background: #22c55e; }
.dot.red { background: #ef4444; }
.dot.orange { background: #f59e0b; }
.dot.empty {
    background: #fff;
    border: 1px solid #111827;
}

.learner-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.learner-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    text-decoration: none;
    box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07);
    border: 1px solid #e5edf8;
    transition: 0.25s ease;
}

.learner-card:hover {
    transform: translateY(-2px);
}

.learner-card-left {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.learner-avatar {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    overflow: hidden;
    flex-shrink: 0;
    background: #f3f4f6;
}

.learner-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.learner-meta {
    min-width: 0;
}

.learner-meta h3 {
    margin: 0 0 6px;
    font-size: 13px;
    font-weight: 700;
    color: #111827;
    line-height: 1.4;
}

.learner-phone {
    display: flex;
    align-items: center;
    gap: 6px;
}

.learner-phone img {
    width: 12px;
    height: 12px;
}

.learner-phone span {
    font-size: 11px;
    font-weight: 600;
    color: #374151;
}

.learner-status-dots {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.app-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
    padding: 18px;
}

.app-modal-overlay.hidden {
    display: none;
}

.app-modal-card {
    width: 100%;
    max-width: 360px;
    background: #fff;
    border-radius: 24px;
    padding: 20px 18px;
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.22);
}

.app-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.app-modal-header h3 {
    margin: 0;
    font-size: 17px;
    font-weight: 700;
    color: #111827;
}

.app-modal-close {
    border: none;
    background: #f3f4f6;
    width: 34px;
    height: 34px;
    border-radius: 10px;
    font-size: 24px;
    cursor: pointer;
}

.filter-form {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-size: 12px;
    font-weight: 700;
    color: #1f2937;
}

.app-input,
.app-select {
    width: 100%;
    min-height: 46px;
    border: 1px solid #dbe4f0;
    border-radius: 14px;
    padding: 12px 14px;
    font-size: 13px;
    color: #111827;
    background: #f9fbff;
    outline: none;
}

.app-input:focus,
.app-select:focus {
    border-color: #2563eb;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
}

.primary-solid-btn {
    background: linear-gradient(135deg, #28388f 0%, #3b82f6 100%);
    color: #fff;
    border: none;
    min-height: 48px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 800;
    cursor: pointer;
    box-shadow: 0 12px 24px rgba(40, 56, 143, 0.22);
}

.full-btn {
    width: 100%;
}

@media (max-width: 380px) {
    .app-body {
        padding: 14px 12px 110px;
    }

    .page-toolbar-top {
        flex-direction: column;
        align-items: stretch;
    }

    .info-strip-secondary {
        flex-direction: column;
        align-items: flex-start;
    }

    .learner-card {
        padding: 12px;
    }

    .learner-status-dots {
        gap: 6px;
    }

    .dot.large {
        width: 16px;
        height: 16px;
    }
}
</style>
<div id="screen7" class="mobile-app-shell">
    @include('user.header')

    <div class="app-body">
        <section class="page-section">

            <div class="page-toolbar-card">
                <div class="page-toolbar-top">
                    <div>
                        <h1 class="page-title">
                            {{ __('messages.Learner_Search_Filter') }}
                            <span class="page-count">[{{ $total }}]</span>
                        </h1>
                    </div>

                    <button type="button" class="action-btn action-btn-soft" onclick="toggleFilterForm()">
                        {{ __('messages.filters') }}
                    </button>
                </div>
            </div>

            <!-- Filter Modal -->
            <div id="toggleSortPopUp()" class="app-modal-overlay hidden">
                <div class="app-modal-card">
                    <div class="app-modal-header">
                        <h3>{{ __('messages.Learner_Search_Filter') }}</h3>
                        <button type="button" class="app-modal-close" onclick="toggleFilterForm()">&times;</button>
                    </div>

                    <form class="filter-form" action="{{ route('user.search.learner') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>{{ __('messages.Enter_Learner_Name') }}</label>
                            <input type="text" name="name" class="app-input">
                        </div>

                        <div class="form-group">
                            <label>{{ __('messages.Primary_Phone_Number') }}</label>
                            <input type="text" name="phone" class="app-input">
                        </div>

                        <div class="form-group">
                            <label>{{ __('messages.email') }}</label>
                            <input type="text" name="email" class="app-input">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="app-input app-select">
                                <option value="">Please choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <button class="primary-solid-btn full-btn" type="submit">
                            Apply
                        </button>
                    </form>
                </div>
            </div>

            <!-- Legend 1 -->
            <div class="info-strip">
                <div class="legend-item">
                    <span class="legend-label warning">Action Required</span>
                    <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                   
                </div>

                <div class="legend-item">
                    <span class="legend-label submitted">Submitted</span>
                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                </div>

                <div class="legend-item">
                    <span class="legend-label accepted">Accepted</span>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>

                <div class="legend-item">
                    <span class="legend-label rejected">Rejected</span>
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                </div>
            </div>

            <!-- Legend 2 -->
            <div class="info-strip info-strip-secondary">
                <span>First Circle - Skills</span>
                <span>Second Circle - Social Protection</span>
                <span>Third Circle - Job</span>
            </div>

            <!-- Learner List -->
            <div class="learner-list">
                @foreach($leanerList as $row)
                    <a href="{{ route('learner.details', ['id' => encryptString($row['item']['id'])]) }}" class="learner-card">
                        <div class="learner-card-left">
                            <div class="learner-avatar">
                                <img src="{{ asset('asset/images/user.jpg') }}" alt="user">
                            </div>

                            <div class="learner-meta">
                                <h3>{{ \Illuminate\Support\Str::limit($row['item']['first_name'], 20) }}</h3>

                                <div class="learner-phone">
                                    <img src="{{ asset('asset/images/phone.png') }}" alt="phone">
                                    <span>{{ $row['item']['primary_phone_number'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="learner-status-dots">
                            {{-- Skills Circle --}}
                            @if($row['item']['completion_status'] == 1)
                                <span class="dot large green"></span>
                            @else
                                <span class="dot large empty"></span>
                            @endif

                            {{-- Social Protection Circle --}}
                            @if($row['social_protection']['is_social_event'])
                                @if($row['social_protection']['is_submitted'] != '' && $row['social_protection']['review_status'] == '')
                                    <span class="dot large blue"></span>
                                @elseif($row['social_protection']['is_submitted'] != '' && $row['social_protection']['review_status'] == 'Rejected')
                                    <span class="dot large red"></span>
                                @elseif($row['social_protection']['is_submitted'] != '' && $row['social_protection']['review_status'] == 'Accepted')
                                    <span class="dot large green"></span>
                                @elseif($row['social_protection']['is_submitted'] == '' && $row['social_protection']['review_status'] == '')
                                    <span class="dot large blue"></span>
                                @elseif($row['social_protection']['is_submitted'] != '' && $row['social_protection']['review_status'] != 'Accepted')
                                    <span class="dot large orange"></span>
                                @else
                                    <span class="dot large empty"></span>
                                @endif
                            @else
                                <span class="dot large empty"></span>
                            @endif

                            {{-- Job Circle --}}
                            @if($row['job_event']['is_job_event'])
                                @if($row['job_event']['is_submitted'] != '' && $row['job_event']['review_status'] == '')
                                    <span class="dot large blue"></span>
                                @elseif($row['job_event']['is_submitted'] != '' && $row['job_event']['review_status'] == 'Rejected')
                                    <span class="dot large red"></span>
                                @elseif($row['job_event']['is_submitted'] != '' && $row['job_event']['review_status'] == 'Accepted')
                                    <span class="dot large green"></span>
                                @elseif($row['job_event']['is_submitted'] != '' && $row['job_event']['review_status'] != 'Accepted')
                                    <span class="dot large orange"></span>
                                @else
                                    <span class="dot large empty"></span>
                                @endif
                            @else
                                <span class="dot large empty"></span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

        </section>
    </div>

    @include('user.bottom_menu')
</div>
 
@endsection
