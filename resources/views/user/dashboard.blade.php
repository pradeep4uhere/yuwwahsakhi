@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')

<div class="mobile-app-shell">
    @include('user.header')

    <div class="app-body">

        <!-- Event Section -->
        <section class="dashboard-section">
            <div class="section-heading">
                <div class="section-icon">
                    <img src="{{ asset('asset/images/file-textcopy.png') }}" alt="Event">
                </div>
                <h3>{{ __('messages.event') }}</h3>
            </div>

            <a href="{{ route('user.allevents') }}" class="summary-card">
                <div>
                    <p class="summary-label">{{ __('messages.all_events') }}</p>
                </div>
                <div class="summary-value">
                    {{ $allEventCount }}/{{ $allsubmittedEventCount }}
                </div>
            </a>
        </section>

        <!-- Opportunities Section -->
        <section class="dashboard-section">
            <div class="section-heading">
                <div class="section-icon">
                    <img src="{{ asset('asset/images/star-textcopy.png') }}" alt="Opportunities">
                </div>
                <h3>{{ __('messages.opportunities') }}</h3>
            </div>

            <a href="{{ route('opportunities', ['filter' => 'desc', 'order_by' => 'id']) }}" class="summary-card">
                <div>
                    <p class="summary-label">{{ __('messages.open_opportunities') }}</p>
                </div>
                <div class="summary-value">
                    {{ $totalOpportunites }}
                </div>
            </a>

            <div class="sub-section-title">
                {{ __('messages.opportunities') }}
            </div>

            @if($opportunites['data']->count() == 0)
                <div class="empty-state">
                    No Opportunity Found
                </div>
            @else
                @foreach($opportunites['data'] as $key => $item)
                    @if($loop->index < 2)
                        <div class="opportunity-card"
                             onclick="window.location.href='{{ route('opportunitiesLearner', ['id' => encryptString($item['id'])]) }}';">

                            <div class="opportunity-top">
                                <h4>{{ $item['opportunities_title'] }}</h4>
                                <span class="badge-soft">{{ __('messages.incentive') }}</span>
                            </div>

                            <div class="opportunity-doc-row">
                                <div class="doc-link-wrap">
                                    <img src="{{ asset('asset/images/file.png') }}" alt="file">
                                    <a href="javascript:void(0)">View Specification Document</a>
                                </div>
                                <img src="{{ asset('asset/images/Group.png') }}" alt="share" class="share-icon">
                            </div>

                            <div class="opportunity-content">
                                <div class="opportunity-meta">
                                    <div class="meta-item price-item">
                                        <img src="{{ asset('asset/images/Rupee Icon.png') }}" alt="rupee">
                                        <span>{{ $item['payout_monthly'] }}/Month</span>
                                    </div>

                                    <div class="meta-item">
                                        <img src="{{ asset('asset/images/calendar.png') }}" alt="start">
                                        <span>{{ __('messages.start') }} - {{ getdateformate($item['start_date']) }}</span>
                                    </div>

                                    <div class="meta-item">
                                        <img src="{{ asset('asset/images/calendar.png') }}" alt="end">
                                        <span>{{ __('messages.end') }} - {{ getdateformate($item['end_date']) }}</span>
                                    </div>

                                    <div class="meta-item">
                                        <img src="{{ asset('asset/images/user.png') }}" alt="openings">
                                        <span>{{ $item['number_of_openings'] }} {{ __('messages.job_oppening') }}</span>
                                    </div>
                                </div>

                                <div class="incentive-box">
                                    <small>{{ __('messages.incentive') }}</small>
                                    <strong>₹{{ $item['incentive'] }}</strong>
                                    <span>/ {{ __('messages.learner') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </section>

        <!-- Learners Section -->
        <section class="dashboard-section">
            <div class="section-heading">
                <div class="section-icon">
                    <img src="{{ asset('asset/images/usersCopy.png') }}" alt="Learners">
                </div>
                <h3>{{ __('messages.learners') }}</h3>
            </div>

            <a href="{{ route('learner') }}" class="summary-card">
                <div>
                    <p class="summary-label">{{ __('messages.total_learners') }}</p>
                </div>
                <div class="summary-value">
                    {{ $learnerCount }}
                </div>
            </a>
        </section>
    </div>

    @include('user.bottom_menu')
    </div>
@endsection
