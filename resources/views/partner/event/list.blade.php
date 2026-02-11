@extends('layouts.list')
@section('title', 'Event')
@section('content')
@include('partner.menu')
<div class="container">
<table width="100%">
    <tr>
        <td style="text-align: left; font-size:24px"><b>Event Transactions List&nbsp;[{{$data->total()}}]</b></td>
        <td style="text-align: right; font-size:14px;font-weight:bold"><a href="{{ route('partner.event.export') }}"><img src="{{ asset('asset/images/download.png') }}" alt="Download" style="height:16px; vertical-align:middle;"> Export Event Transactions</a></td>
    </tr>
</table>
        <div class="table-container">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Agent ID</th>
                <th>Unit Institute</th>
                <th>Event Name</th>
                <th>Event Category</th>
                <th>Beneficiary Name</th>
                <th>Beneficiary Number</th>
                <th>Event Status</th>
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
                <td nowrap="nowrap">{{ $item->sakhi_id }}</td>
                <td nowrap="nowrap">{{ $item->csc_id }}</td>
                <td nowrap="nowrap">{{ $item->event_name }}</td>
                <td>{{ $item->event_category }}</td>
                <td>{{ $item->beneficiary_name }}</td>
                <td>{{ $item->beneficiary_phone_number }}</td>
                <td>{{ $item->review_status }}</td>
               
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
                        Comment
                    </a>
                </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
            <div class="pagination">
            {{ $data->links('pagination::bootstrap-5') }}
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


