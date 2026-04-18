<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- for date -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- password icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('asset/css/user_style.css')}}">
  <!-- <script src="index.js" defer></script> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<style>
    .app-header-wrap {
    position: sticky;
    top: 0;
    z-index: 100;
    background: linear-gradient(180deg, rgba(248,251,255,0.98) 0%, rgba(240,246,255,0.96) 100%);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid rgba(226, 232, 240, 0.85);
}

.premium-mobile-header {
    max-width: 430px;
    margin: 0 auto;
    min-height: 78px;
    padding: 14px 16px;
    display: grid;
    grid-template-columns: 56px 1fr 88px;
    align-items: center;
    gap: 10px;
    position: relative;
}

.header-left,
.header-right {
    display: flex;
    align-items: center;
}

.header-left {
    justify-content: flex-start;
}

.header-center {
    display: flex;
    justify-content: center;
    align-items: center;
}

.header-right {
    justify-content: flex-end;
    gap: 10px;
}

.header-logo-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.header-logo {
    width: 48px;
    height: 58px;
    object-fit: contain;
    display: block;
}

.header-action-btn {
    width: 42px;
    height: 42px;
    border: 0;
    outline: none;
    border-radius: 14px;
    background: linear-gradient(180deg, #ffffff 0%, #eef4ff 100%);
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.25s ease;
    padding: 0;
}

.header-action-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
}

.header-action-btn img {
    width: 18px;
    height: 18px;
    object-fit: contain;
}

.header-icon-img {
    width: 20px;
    height: 20px;
}

.notification-btn i {
    font-size: 22px;
    color: #111827;
    line-height: 1;
}

.back-btn img {
    width: 18px;
    height: 18px;
}

.menu-btn {
    flex-direction: column;
    gap: 4px;
}

.menu-btn span {
    display: block;
    width: 17px;
    height: 2px;
    border-radius: 20px;
    background: #111827;
    transition: 0.25s ease;
}

/* Language Modal */
.language-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
    padding: 18px;
}

.language-modal-overlay.hidden {
    display: none;
}

.language-modal-card {
    width: 100%;
    max-width: 360px;
    background: #ffffff;
    border-radius: 24px;
    padding: 22px 18px 18px;
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.22);
    animation: modalPop 0.2s ease;
}

@keyframes modalPop {
    from {
        opacity: 0;
        transform: translateY(10px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.language-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 18px;
}

.language-modal-header h3 {
    font-size: 17px;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

.language-close-btn {
    border: none;
    background: #f3f6fb;
    width: 34px;
    height: 34px;
    border-radius: 10px;
    font-size: 26px;
    line-height: 1;
    color: #1f2937;
    cursor: pointer;
}

.language-form-group {
    margin-bottom: 18px;
}

.language-form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #344054;
}

.language-select {
    width: 100%;
    height: 48px;
    border: 1px solid #dbe4f0;
    border-radius: 14px;
    padding: 0 14px;
    font-size: 14px;
    color: #111827;
    outline: none;
    background: #f9fbff;
}

.language-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
}

.language-submit-btn {
    width: 100%;
    border: none;
    border-radius: 14px;
    background: linear-gradient(135deg, #28388f 0%, #3b82f6 100%);
    color: #ffffff;
    font-size: 14px;
    font-weight: 700;
    padding: 14px 16px;
    cursor: pointer;
    box-shadow: 0 12px 24px rgba(40, 56, 143, 0.22);
    transition: 0.25s ease;
}

.language-submit-btn:hover {
    transform: translateY(-1px);
}

@media (max-width: 380px) {
    .premium-mobile-header {
        grid-template-columns: 48px 1fr 82px;
        padding: 12px 12px;
        min-height: 72px;
    }

    .header-logo {
        width: 42px;
        height: 52px;
    }

    .header-action-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
    }

    .notification-btn i {
        font-size: 20px;
    }
}


.bottom-nav {
    position: sticky;
    bottom: 0;
    width: 100%;
    background: #1e3a8a;
    padding: 10px 16px calc(10px + env(safe-area-inset-bottom));
    display: flex;
    justify-content: space-around;
    align-items: center;
    border-top-left-radius: 22px;
    border-top-right-radius: 22px;
    box-shadow: 0 -10px 30px rgba(30, 58, 138, 0.20);
}

.bottom-nav a {
    color: rgba(255,255,255,0.75);
    font-size: 12px;
    font-weight: 600;
}

.bottom-nav a.active {
    background: #ffffff;
    color: #1e3a8a;
    width: 46px;
    height: 46px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Montserrat', sans-serif;
    background: #eef2f7;
    color: #1d2433;
}

a {
    text-decoration: none;
}

.mobile-app-shell {
    width: 100%;
    max-width: 430px;
    margin: 0 auto;
    min-height: 100vh;
    background: linear-gradient(180deg, #f8fbff 0%, #eef4fb 100%);
    position: relative;
    box-shadow: 0 10px 40px rgba(31, 41, 55, 0.12);
    overflow: hidden;
}

.app-body {
    padding: 18px 16px 90px;
}

.dashboard-section {
    margin-bottom: 22px;
}

.section-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    padding-left: 2px;
}

.section-heading h3 {
    font-size: 16px;
    font-weight: 700;
    color: #1f2937;
}

.section-icon {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    background: linear-gradient(135deg, #ffffff 0%, #edf4ff 100%);
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.10);
    display: flex;
    align-items: center;
    justify-content: center;
}

.section-icon img {
    width: 18px;
    height: 18px;
    object-fit: contain;
}

.summary-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 16px 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    border: 1px solid rgba(226, 232, 240, 0.8);
    transition: 0.25s ease;
    margin-bottom: 14px;
}

.summary-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 34px rgba(15, 23, 42, 0.12);
}

.summary-label {
    font-size: 14px;
    font-weight: 600;
    color: #344054;
}

.summary-value {
    min-width: 72px;
    height: 42px;
    border-radius: 14px;
    background: linear-gradient(135deg, #00b4db 0%, #2563eb 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    font-weight: 700;
    padding: 0 12px;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.22);
}

.sub-section-title {
    font-size: 14px;
    font-weight: 700;
    color: #475467;
    margin: 8px 0 12px;
    padding-left: 4px;
}

.empty-state {
    background: #fff1f2;
    color: #be123c;
    border: 1px solid #fecdd3;
    padding: 14px 16px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 600;
}

.opportunity-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 16px;
    margin-bottom: 14px;
    box-shadow: 0 12px 30px rgba(40, 56, 143, 0.10);
    border: 1px solid #e8eef8;
    cursor: pointer;
    transition: all 0.25s ease;
}

.opportunity-card:hover {
    transform: translateY(-2px);
}

.opportunity-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 12px;
}

.opportunity-top h4 {
    font-size: 14px;
    font-weight: 700;
    line-height: 1.45;
    color: #111827;
    flex: 1;
}

.badge-soft {
    background: #eef2ff;
    color: #4f46e5;
    font-size: 11px;
    font-weight: 700;
    padding: 7px 10px;
    border-radius: 999px;
    white-space: nowrap;
}

.opportunity-doc-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.doc-link-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
}

.doc-link-wrap img {
    width: 15px;
    height: 15px;
}

.doc-link-wrap a {
    font-size: 11px;
    font-weight: 600;
    color: #3b82f6;
    text-decoration: underline;
    line-height: 1.4;
}

.share-icon {
    width: 18px;
    height: 18px;
    opacity: 0.8;
}

.opportunity-content {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    align-items: stretch;
}

.opportunity-meta {
    flex: 1;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
}

.meta-item img {
    width: 14px;
    height: 14px;
    object-fit: contain;
}

.meta-item span {
    font-size: 11px;
    font-weight: 600;
    color: #374151;
    line-height: 1.4;
}

.price-item span {
    color: #28388F;
    font-weight: 700;
}

.incentive-box {
    width: 95px;
    min-width: 95px;
    border-radius: 16px;
    background: linear-gradient(180deg, #28388f 0%, #1d2a73 100%);
    color: #fff;
    padding: 12px 10px;
    text-align: center;
    box-shadow: 0 10px 22px rgba(40, 56, 143, 0.22);
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.incentive-box small {
    font-size: 10px;
    opacity: 0.85;
    margin-bottom: 6px;
}

.incentive-box strong {
    font-size: 15px;
    font-weight: 800;
    line-height: 1.2;
}

.incentive-box span {
    font-size: 10px;
    opacity: 0.92;
    margin-top: 4px;
}


@media (max-width: 380px) {
    .app-body {
        padding: 16px 12px 90px;
    }

    .summary-card {
        padding: 14px;
    }

    .summary-value {
        min-width: 62px;
        font-size: 15px;
    }

    .opportunity-content {
        flex-direction: column;
    }

    .incentive-box {
        width: 100%;
        min-width: 100%;
    }
}


</style>
<style>
  .sidebar-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.38);
    z-index: 140;
    opacity: 1;
    transition: 0.25s ease;
}

.sidebar-overlay.hidden {
    display: none;
}

.premium-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 86%;
    max-width: 320px;
    height: 100vh;
    background: linear-gradient(180deg, #ffffff 0%, #f5f9ff 100%);
    z-index: 150;
    box-shadow: 18px 0 40px rgba(15, 23, 42, 0.18);
    transform: translateX(-105%);
    transition: transform 0.28s ease;
    display: flex;
    flex-direction: column;
    padding: 18px 16px 20px;
    border-top-right-radius: 26px;
    border-bottom-right-radius: 26px;
}

.premium-sidebar.open {
    transform: translateX(0);
}

.sidebar-top {
    flex-shrink: 0;
}

.sidebar-brand-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sidebar-brand img {
    width: 42px;
    height: 52px;
    object-fit: contain;
}

.sidebar-brand h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 800;
    color: #111827;
}

.sidebar-brand p {
    margin: 2px 0 0;
    font-size: 11px;
    color: #667085;
    font-weight: 600;
}

.sidebar-close-btn {
    width: 36px;
    height: 36px;
    border: none;
    background: #eef4ff;
    color: #1f2937;
    font-size: 24px;
    line-height: 1;
    border-radius: 12px;
    cursor: pointer;
}

.sidebar-user-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    border-radius: 18px;
    background: linear-gradient(135deg, #eef4ff 0%, #ffffff 100%);
    border: 1px solid #dbe7ff;
    box-shadow: 0 8px 22px rgba(37, 99, 235, 0.08);
    margin-bottom: 18px;
}

.sidebar-user-avatar {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    background: linear-gradient(135deg, #28388f 0%, #3b82f6 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 800;
    flex-shrink: 0;
}

.sidebar-user-info h4 {
    margin: 0;
    font-size: 14px;
    font-weight: 800;
    color: #111827;
}

.sidebar-user-info p {
    margin: 3px 0 0;
    font-size: 11px;
    color: #667085;
    word-break: break-word;
}

.sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
    overflow-y: auto;
    padding-right: 2px;
}

.sidebar-menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 48px;
    padding: 12px 14px;
    border-radius: 16px;
    text-decoration: none;
    color: #1f2937;
    font-size: 13px;
    font-weight: 700;
    transition: 0.22s ease;
}

.sidebar-menu-item:hover {
    background: #eef4ff;
    color: #28388f;
}

.sidebar-menu-item.active {
    background: linear-gradient(135deg, #28388f 0%, #3b82f6 100%);
    color: #fff;
    box-shadow: 0 12px 24px rgba(40, 56, 143, 0.22);
}

.sidebar-menu-icon {
    width: 22px;
    text-align: center;
    font-size: 16px;
    flex-shrink: 0;
}

.sidebar-bottom {
    padding-top: 14px;
    flex-shrink: 0;
}

.sidebar-logout-btn {
    width: 100%;
    min-height: 48px;
    border: none;
    border-radius: 16px;
    background: #fff1f2;
    color: #be123c;
    font-size: 13px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    border: 1px solid #fecdd3;
}

@media (max-width: 380px) {
    .premium-sidebar {
        width: 90%;
        padding: 16px 14px 18px;
    }
}
</style>
</head>
<body class="font-Montserrat">
 @yield('content')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    function loadDistricts(stateId) {
        if (stateId) {
            $.ajax({
                url: "{{ route('getdistricts', ['state_id' => 'REPLACE_ID']) }}".replace('REPLACE_ID', stateId),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let districtSelect = $('#responseDistrict');
                    districtSelect.html(data.html)
                },
                error: function () {
                    alert('Failed to load districts.');
                }
            });
        } else {
            $('#district_id').empty().append('<option value="">Select District</option>');
        }
    }
</script>
<script>
$(document).ready(function() {
    // When district dropdown changes, load blocks
    $(document).on('change', '#district_id', function () {
        var districtId = $(this).val();

        if (districtId) {
            $.ajax({
                url: "{{route('getblock')}}",
                type: 'GET',
                data: { district_id: districtId },
                success: function (response) {
                    $('#blockWrapper').html(response.html);
                },
                error: function () {
                    alert('Error fetching blocks');
                }
            });
        } else {
            $('#blockWrapper').html("<select name='block_id' class='form-control' id='block_id'><option value=''>Select District First</option></select>");
        }
    });
});

</script>
<script src="{{asset('asset/js/index.js')}}" defer></script>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('appSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.toggle('open');
        overlay.classList.toggle('hidden');
    }
</script>
</body>
</html>