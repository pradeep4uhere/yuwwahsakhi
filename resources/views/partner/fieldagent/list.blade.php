@extends('layouts.list')
@section('title', 'Event')
@section('content')
@include('partner.menu')
<div class="container">
<form>
       <table class="table w-100">
            <tr>
                <td style="width:88%" colspan="5"><h1>Field Agent [{{$data->total()}}]</h1></td>
                <td text-align="right"><a href="{{route('partner.filed-agents.export')}}"><b><img src="{{asset('asset/images/export.jpg')}}" width="25px" height="25px">&nbsp;Export Field Agent</b></a></td>
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
                <th>Agent ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Partner Division</th>
                <th>Learner</th>
                <th>Created Date</th>
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
                <td><a href="{{route('partner.viewfieldagent',['id'=>encryptString($item->id)])}}" class="text-primary">{{ $item->csc_id }}</a></td>
                <td>{{ $item->sakhi_id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->contact_number }}</td>
                <td>{{ $item->email }}</td>
             
                <td>{{ $item->PartnerCenter->center_name}}</td>
                <td class="text-center">{{ $item->learner_count}}</td>
                <td>{{ $item->created_at }}</td>
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


