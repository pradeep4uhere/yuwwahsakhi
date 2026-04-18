@extends('layouts.user')
@section('title', 'All Event List')
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
    overflow: hidden;
}

.app-body {
    padding: 16px 14px 90px;
}

.page-section {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.page-toolbar {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-top: 4px;
}

.page-title {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

.page-count {
    color: #2563eb;
    font-weight: 800;
}

.page-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.action-btn {
    border: none;
    border-radius: 14px;
    min-height: 40px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: 0.25s ease;
}

.action-btn-primary {
    background: linear-gradient(135deg, #28388f 0%, #3b82f6 100%);
    color: #fff;
    box-shadow: 0 10px 20px rgba(40, 56, 143, 0.22);
}

.action-btn-soft {
    background: #eaf1ff;
    color: #28388f;
    border: 1px solid #cdddff;
}

.action-btn:hover {
    transform: translateY(-1px);
}

.event-card {
    background: #fff;
    border-radius: 20px;
    padding: 16px 14px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    border: 2px solid transparent;
    cursor: pointer;
    transition: 0.25s ease;
}

.event-card:hover {
    transform: translateY(-2px);
}

.status-accepted {
    border-color: #22c55e;
}

.status-rejected {
    border-color: #ef4444;
}

.event-card-header {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    align-items: flex-start;
    margin-bottom: 12px;
}

.event-beneficiary {
    font-size: 12px;
    line-height: 1.55;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

.event-status-badge {
    white-space: nowrap;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 10px;
    border-radius: 999px;
    background: #eef2ff;
    color: #4338ca;
}

.event-details {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.detail-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.detail-row i {
    font-size: 14px;
    color: #111827;
    min-width: 16px;
    margin-top: 2px;
}

.detail-row img {
    width: 14px;
    height: 14px;
    object-fit: contain;
    min-width: 14px;
    margin-top: 2px;
}

.detail-row p {
    margin: 0;
    font-size: 12px;
    line-height: 1.6;
    color: #374151;
    word-break: break-word;
}

.detail-row strong {
    color: #111827;
    font-weight: 700;
}

.align-start {
    align-items: flex-start;
}

.divider {
    display: inline-block;
    margin: 0 6px;
    color: #94a3b8;
}

.event-actions {
    margin-top: 14px;
    padding-top: 12px;
    border-top: 1px solid #e5e7eb;
}

.submit-event-btn {
    width: 100%;
    min-height: 44px;
    border-radius: 14px;
    border: 1px solid #b7c8ff;
    background: #eef4ff;
    color: #28388f;
    font-size: 13px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.empty-alert {
    background: #fff1f2;
    color: #be123c;
    border: 1px solid #fecdd3;
    padding: 14px 16px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 600;
    margin-top: 8px;
}

/* Modal */
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
    background: #ffffff;
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

.sort-links-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.sort-links-list a {
    padding: 12px 14px;
    border-radius: 14px;
    background: #f8fafc;
    color: #1f2937;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid #e5e7eb;
}

.sort-links-list a:hover {
    background: #eef4ff;
    color: #28388f;
}

@media (max-width: 380px) {
    .app-body {
        padding: 14px 12px 90px;
    }

    .page-actions {
        gap: 6px;
    }

    .action-btn {
        font-size: 11px;
        padding: 9px 12px;
    }

    .event-card {
        padding: 14px 12px;
    }

    .event-card-header {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
<div id="screen7" class="mobile-app-shell">
    @include('user.header')

    <div class="app-body">
        <section class="page-section">
            <div class="page-toolbar">
                <div class="page-title-wrap">
                    <h1 class="page-title">
                        {{ __('messages.all_events') }}
                        <span class="page-count">[{{ $allEventCount }}]</span>
                    </h1>
                </div>

                <div class="page-actions">
                    <a href="{{ route('upload') }}" class="action-btn action-btn-primary">
                        {{ __('messages.add_event') }}
                    </a>

                    <button type="button" class="action-btn action-btn-soft" onclick="toggleFilterForm()">
                        {{ __('messages.filters') }}
                    </button>

                    <button type="button" class="action-btn action-btn-soft" onclick="toggleSortPopUp()">
                        {{ __('messages.sort_by') }}
                    </button>
                </div>
            </div>

            @include('user.event_filter')

            <!-- Sort Popup -->
            <div id="togglePopUp" class="app-modal-overlay hidden">
                <div class="app-modal-card">
                    <div class="app-modal-header">
                        <h3>{{ __('messages.sort_by') }}</h3>
                        <button type="button" class="app-modal-close" onclick="toggleSortPopUp()">&times;</button>
                    </div>

                    <div class="sort-links-list">
                        <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'id']) }}">
                            {{ __('messages.new_event') }}
                        </a>

                        <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'event_date_submitted']) }}">
                            {{ __('messages.all_submitted_event') }}
                        </a>

                        <a href="{{ route('user.allevents', ['filter' => 'asc', 'order_by' => 'event_date_created']) }}">
                            {{ __('messages.earliest_ending_event') }}
                        </a>

                        <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'event_date_created']) }}">
                            {{ __('messages.newest_to_oldest') }}
                        </a>

                        <a href="{{ route('user.allevents', ['filter' => 'asc', 'order_by' => 'event_date_created']) }}">
                            {{ __('messages.oldest_to_newest') }}
                        </a>
                    </div>
                </div>
            </div>

            @if($eventList->count() > 0)
                @foreach($eventList as $item)
                    @php
                        $isAccepted = $item['review_status'] == 'Accepted' && $item['event_date_submitted'] != '';
                        $statusClass = $isAccepted ? 'status-accepted' : 'status-rejected';
                    @endphp

                    <div class="event-card {{ $statusClass }}" onclick="toggleButtons(event)">
                        <div class="event-card-header">
                            <div>
                                <p class="event-beneficiary">
                                    {{ __('messages.beneficiary') }} :
                                    {{ $item['beneficiary_name'] }} | {{ $item['beneficiary_phone_number'] }}
                                </p>
                            </div>

                            <span class="event-status-badge">
                                {{ $item['review_status'] ?? 'Pending' }}
                            </span>
                        </div>

                        <div class="event-details">
                            <div class="detail-row">
                                <i class="fa-regular fa-clock"></i>
                                <p>
                                    <strong>{{ __('messages.event_name') }}:</strong>
                                    {{ $item['event_name'] ?? '' }}
                                </p>
                            </div>

                            <div class="detail-row">
                                <img src="{{ asset('asset/images/calendar.png') }}" alt="calendar">
                                <p>
                                    <strong>{{ __('messages.event_type') }}:</strong>
                                    {{ ($item['EventType'] != null) ? $item['EventType']['name'] : '' }}
                                    |
                                    {{ ($item['Event'] != null) ? $item['Event']['event_category'] : '' }}
                                </p>
                            </div>

                            <div class="detail-row">
                                <i class="fa-regular fa-calendar-days"></i>
                                <p>
                                    <strong>{{ __('messages.event_value') }}:</strong>
                                    {{ $item['event_value'] ?? '' }}
                                </p>
                            </div>

                            <div class="detail-row">
                                <img src="{{ asset('asset/images/calendar.png') }}" alt="calendar">
                                <p>
                                    <strong>{{ __('messages.created_date') }}</strong> -
                                    {{ getdateformate($item['event_date_created']) }}

                                    @if($item['event_date_submitted'] != '')
                                        <span class="divider">|</span>
                                        <strong>{{ __('messages.submitted_date') }}</strong> -
                                        {{ getdateformate($item['event_date_submitted']) }}
                                    @endif
                                </p>
                            </div>

                            <div class="detail-row align-start">
                                <i class="fa-regular fa-comment-dots"></i>
                                <p>
                                    <strong>{{ __('messages.comment') }}:</strong>
                                    {!! optional(getEventComment($item['id'], true))->comment ?? 'N/A' !!}
                                </p>
                            </div>
                        </div>

                        @if(!$isAccepted)
                            <div class="buttonsContainer event-actions hidden">
                                <a href="{{ route('viewevent', ['id' => encryptString($item['id'])]) }}" class="submit-event-btn">
                                    {{ __('messages.submit_event') }}
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="empty-alert">
                    {{ __('messages.no_event_found') }}
                </div>
            @endif
        </section>
    </div>
    @include('user.bottom_menu')

</div>
<script>
    function toggleButtons(event) {
        const card = event.currentTarget;
        const buttonsContainer = card.querySelector(".buttonsContainer");

        if (!buttonsContainer) return;

        const isVisible = !buttonsContainer.classList.contains("hidden");

        document.querySelectorAll(".buttonsContainer").forEach(el => {
            el.classList.add("hidden");
        });

        if (!isVisible) {
            buttonsContainer.classList.remove("hidden");
        }

        event.stopPropagation();
    }

    document.addEventListener("click", function (event) {
        if (!event.target.closest(".event-card")) {
            document.querySelectorAll(".buttonsContainer").forEach(el => {
                el.classList.add("hidden");
            });
        }
    });
</script>
@endsection
