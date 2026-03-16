@extends('layouts.list')
@section('title', 'Event')
@section('content')
@include('partner.menu')
<div class="container">
<table width="100%">
    <tr>
        <td style="text-align: left; font-size:24px"><b>Event Transactions List&nbsp;[{{$data->total()}}]</b></td>
        <td style="text-align: right; font-size:14px;font-weight:bold"><a href="{{ route('partner-events-export') }}"><img src="{{ asset('asset/images/download.png') }}" alt="Download" style="height:16px; vertical-align:middle;"> Export Event Transactions</a></td>
    </tr>
</table>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Agent ID</th>
                <th>Unit Institute</th>
                <th>Event Name</th>
                <th nowrap="nowrap">Event Category</th>
                <th nowrap="nowrap">Beneficiary Name</th>
                <th nowrap="nowrap">Beneficiary Number</th>
                <th nowrap="nowrap">Event Status</th>
                <th nowrap="nowrap">Event Submitted</th>
                <th nowrap="nowrap">Documents</th>
                <th nowrap="nowrap">Differently Abled</th>
                <th nowrap="nowrap">Education Level</th>
                <th nowrap="nowrap">Course Name</th>
                <th nowrap="nowrap">Marital Status</th>
                <th nowrap="nowrap">Religion</th>
                <th nowrap="nowrap">Digital Proficiency Level</th>
                <th nowrap="nowrap">English Proficiency Level</th>
                <th nowrap="nowrap">Interested Opportunities</th>
                <th nowrap="nowrap">Function Type</th>
                <th nowrap="nowrap">Industry Type</th>
            
                <th nowrap="nowrap">Comment</th>
                <th nowrap="nowrap">Updated</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1;  //dd($data);?>
            @foreach ($data as $index => $item)
            @php 
                // Decode safely — handle null or invalid JSON
                $document = json_decode($item->uploaded_doc_links ?? '[]', true) ?? [];
                //dd($document)
            @endphp
            <tr>
                <td>{{$count}}</td>
                <td nowrap="nowrap">{{ $item->sakhi_id }}</td>
                <td nowrap="nowrap">{{ $item->csc_id }}</td>
                <td nowrap="nowrap">{{ $item->event_name }}</td>
                <td nowrap="nowrap">{{ $item->event_category }}</td>
                <td nowrap="nowrap">{{ $item->beneficiary_name }}</td>
                <td nowrap="nowrap">{{ $item->beneficiary_phone_number }}</td>
                <td nowrap="nowrap">{{ $item->review_status }}</td>
               
                <td nowrap="nowrap">{{ $item->event_date_submitted }}</td>
                <td nowrap="nowrap">
                @if(!empty($document))
                        @foreach ($document as $doc)
                            <a href="{{ asset('storage/'.$doc) }}" target="_blank">View</a><br>
                        @endforeach
                       
                    @else
                        <span>No Document</span>
                    @endif
                </td>
                <th nowrap="nowrap">{{$item->DIFFRENTLY_ABLED}}</th>
                <th nowrap="nowrap">{{$item->education_level}}</th>
                <th nowrap="nowrap">{{$item->course_name}}</th>
                <th nowrap="nowrap">{{$item->USER_MARIAL_STATUS}}</th>
                <th nowrap="nowrap">{{$item->RELIGION}}</th>
                <th nowrap="nowrap">{{$item->digital_proficiency}}</th>
                <th nowrap="nowrap">{{$item->english_knowledge}}</th>
                <th nowrap="nowrap">{{$item->interested_in_opportunities}}</th>
                <th nowrap="nowrap">{{$item->field_type}}</th>
                <th nowrap="nowrap">{{$item->industry_type}}</th>
                <!-- <td nowrap="nowrap">
                @if(!empty($document))
                     @foreach ($document as $doc)
                        @php
                            $fileName = basename($doc);
                        @endphp
                        <a href="{{ route('document.download', $fileName) }}">
                            Download
                        </a>
                        <br/>
                    @endforeach
                    @else
                    @endif
                </td> -->
                <td>
                <a href="#" 
                        class="btn btn-primary btn-sm view-comments" 
                        data-event-id="{{ $item->id }}">
                        Comment
                    </a>
                </td>
                <td nowrap="nowrap">{{ $item->updated_at }}</td>
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


