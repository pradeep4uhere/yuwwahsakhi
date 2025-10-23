@extends('layouts.list')
@section('title', 'Event')
@section('content')
@include('partner.menu')
<div class="container">
<table width="100%">
    <tr>
        <td style="text-align: left; font-size:24px"><b>Event Transactions List</b></td>
        <!-- <td style="text-align: right; font-size:14px;font-weight:bold"><a href="{{ route('partner.event.export') }}"><img src="{{ asset('asset/images/download.png') }}" alt="Download" style="height:16px; vertical-align:middle;"> Export Event Transactions</a></td> -->
    </tr>
</table>
        <div class="table-container">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Event Name</th>
                <th>Event Category</th>
                <th>Beneficiary Name</th>
                <th>Beneficiary Phone Number</th>
                <th>Event Status</th>
                <th>Monthly Income</th>
                <th>Event Created</th>
                <th>Event Submitted</th>
                <th>Documents</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1;  //dd($data);?>
            @foreach ($data as $index => $item)
            @php 
                // Decode safely — handle null or invalid JSON
                $document = json_decode($item->uploaded_doc_links ?? '[]', true) ?? [];
            @endphp
            <tr>
                <td>{{$count}}</td>
                <td>{{ $item->event_name }}</td>
                <td>{{ $item->event_category }}</td>
                <td>{{ $item->beneficiary_name }}</td>
                <td>{{ $item->beneficiary_phone_number }}</td>
                <td>{{ $item->review_status }}</td>
                <td>Rs. {{ $item->event_value }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->event_date_submitted }}</td>
                <td>
                @if(!empty($document))
                        @foreach ($document as $doc)
                            <a href="{{ $doc }}" target="_blank">View</a><br>
                        @endforeach
                    @else
                        <span>No Document</span>
                    @endif
                </td>
                <td>
                <a href="#" 
                        class="btn btn-primary btn-sm view-comments" 
                        data-event-id="{{ $item->id }}">
                        View Comment
                    </a>
                </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
            <div class="pagination">
            {{ $data['pagination_links'] ?? '' }}
            </div>
        </div>
    </div>
    <!-- Pagination -->
</div>


<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLabel">Event Transaction Comments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="commentList">Loading...</div>
      </div>
    </div>
  </div>
</div>



@endsection


