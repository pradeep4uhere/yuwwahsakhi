@extends('layouts.list')
@section('title', 'Event')
@section('content')
@include('partner.menu')
<style>
.table-container {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on mobile */
}

.circle-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #dedede; /* change color */
    color: #000;
    font-size: 14px;
}

.circle-badge-blue {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #0036ffa6; /* change color */
    color: #fff;
    font-size: 14px;
}


.circle-badge-orange {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #ff3900ba; /* change color */
    color: #fff;
    font-size: 14px;
}

.circle-badge-green {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #349f00; /* change color */
    color: #fff;
    font-size: 14px;
}


.circle-badge-red {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #e01010cf; /* change color */
    color: #fff;
    font-size: 14px;
}
</style>
<div class="container">
<form>
       <table class="table w-100">
            <tr>
                <td  colspan="1"><h1>Field Agent [{{$data->total()}}]</h1></td>
                <td text-align="right" colspan="5">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Total Job / Event</strong>&nbsp;&nbsp;<span class="circle-badge" >21</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                Total Submitted&nbsp;&nbsp;<span class="circle-badge-blue">11</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                Total Action Required&nbsp;&nbsp;<span class="circle-badge-orange">5</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                Total Accepted&nbsp;&nbsp;<span class="circle-badge-green">2</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                Total Rejected&nbsp;&nbsp;<span class="circle-badge-red">3</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="{{route('partner.filed-agents.export')}}"><b><img src="{{asset('asset/images/export.jpg')}}" width="25px" height="25px">&nbsp;Export Field Agent</b></a></td>
            </tr>
            <tr>
                <td style="width:10%"><input type="text" name="csc_id" class="form-control" placeholder="Agent ID"/></td>
                <td style="width:10%"><input type="text" name="contact_number" class="form-control" placeholder="Mobile Number"/></td>
                <td style="width:10%"><input type="text" name="email" class="form-control" placeholder="Email Address"/></td>
                <td style="width:10%">
                    <select name="state" class="form-control" id="state">
                    <option value="">--Choose State--</option>
                    @foreach($statetdata as $item)
                        <option value="{{ $item->state }}">
                            {{ $item->state }}
                        </option>
                    @endforeach
                    </select>
                </td>
                <td style="width:10%">
                    <select name="district" id="district"  class="form-control">
                        <option value="">--Choose District--</option>
                    </select>
                </td>
                <td style="width:10%"><input type="submit" name="submit" class="form-control bg-primary font-white" Value="Search"/></td>
            </tr>
        </table>
</form>
            <div class="table-container">
            <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Programe Code</th>
                    <th nowrap="nowrap">Agent ID</th>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Partner Division</th>
                    <th>Learner Reg.</th>
                    <th title="Total course completed">Total Cert.</th>
                    <th>Total Jobs</th>
                    <th>Social Protection</th>
                
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
        <?php $count=1;  //dd($data);?>
            @foreach ($data as $index => $item)
            @php 
                //dd($item);
                // Decode safely — handle null or invalid JSON
                $document = json_decode($item->uploaded_doc_links ?? '[]', true) ?? [];
            @endphp
            <tr>
                <td>{{$count}}</td>
                <td nowrap="nowrap"><a href="{{route('partner.viewfieldagent',['id'=>encryptString($item->id)])}}" class="text-primary">{{ $item->csc_id }}</a></td>
                <td nowrap="nowrap">{{ $item->sakhi_id }}</td>
                <td nowrap="nowrap">{{ $item->name }}</td>
                <td>{{ $item->contact_number }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->PartnerCenter->center_name}}</td>
                <td class="text-center">{{ $item->learner_count}}</td>
                <td class="text-center">
                <span class="circle-badge"  >{{ $item['Learner']['course_completed']}}</span></td>
                <td class="text-center" nowrap="nowrap">
                @if($item['Learner']['job_total'])
                <span class="circle-badge">{{$item['Learner']['job_total']}}</span>
                <span class="circle-badge-blue">{{ $item['Learner']['job_submitted']}}</span>
                <span class="circle-badge-orange">{{ $item['Learner']['job_pending']}}</span>
                <span class="circle-badge-green">{{ $item['Learner']['job_accepted']}}</span>
                <span class="circle-badge-red">{{ $item['Learner']['job_rejected']}}</span>
                @endif
                
                </td>
                <td class="text-center" nowrap="nowrap" >
                @if($item['Learner']['social_total'])
                <span class="circle-badge" >{{ $item['Learner']['social_total']}}</span>
                <span class="circle-badge-blue">{{ $item['Learner']['social_open']}}</span>
                <span class="circle-badge-orange">{{ $item['Learner']['social_pending']}}</span>
                <span class="circle-badge-green">{{ $item['Learner']['social_accepted']}}</span>
                <span class="circle-badge-red">{{ $item['Learner']['social_rejected']}}</span>
                @endif
                </td>
               
                <td>@if($item->learner_count>0)
                    <a href="{{route('partner.viewfieldagent',['id'=>encryptString($item->id)])}}" class="text-primary fw-bold">View</a>
                    @else
                    View
                    @endif
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


