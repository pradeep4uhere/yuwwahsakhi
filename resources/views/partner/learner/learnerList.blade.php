@extends('layouts.list')
@section('title', 'Event')
@section('content')
@include('partner.menu')
<div class="container">
       <table class="table w-100">
            <tr>
                <td style="width:88%" style="padding-top:35px;" ><h1><img src="{{asset('asset/images/Profile.png')}}" hegiht="55px" width="55px">Learner [{{$data->total()}}]&nbsp;|&nbsp;<img src="{{asset('asset/images/certificate.png')}}" hegiht="25px" width="25px">&nbsp;Total Certification&nbsp;[{{$totalCompletionLearner}}]</h1></td>
               
                <td text-align="right" nowrap="nowrap" style="padding-top:25px;">
                <a href="{{ route('export.partner.exportlearner', request()->query()) }}">
                        <b>
                            <img src="{{ asset('asset/images/export.jpg') }}" width="25" height="25">
                            &nbsp;Export Learner
                        </b>
                    </a>

                </td>
            </tr>
          
        </table>
        <form>
        <div>
        <div class="mb-3">
        @php
                $filters = [
                    'name' => 'Name',
                    'primary_phone_number' => 'Mobile',
                    'PROGRAM_STATE' => 'State',
                    'district' => 'District',
                    'unit_institute' => 'Unit Institute'
                ];
            @endphp
                <strong>Search Result For:</strong>

                @if(request()->filled('name'))
                    <span>Name: {{ request('name') }}</span> |
                @endif

                @if(request()->filled('primary_phone_number'))
                    <span>Mobile: {{ request('primary_phone_number') }}</span> |
                @endif

                @if(request()->filled('PROGRAM_STATE'))
                    <span>State: {{ request('PROGRAM_STATE') }}</span> |
                @endif

                @if(request()->filled('district'))
                    <span>District: {{ request('district') }}</span> |
                @endif

                @if(request()->filled('unit_institute'))
                    <span>Unit Institute: {{ request('unit_institute') }}</span>
                @endif
            </div>
        </div>
        <table>
        <tr>
            <td style="width:10%"><input type="text" name="name" class="form-control" placeholder="Name"/></td>
            <td style="width:10%"><input type="text" name="primary_phone_number" class="form-control" placeholder="Mobile Number"/></td>
            <td style="width:10%"><input type="text" name="unit_institute" class="form-control" placeholder="Unit Institute Name"/></td>
            <td style="width:10%">
            <select name="PROGRAM_STATE" class="form-control" id="state">
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
        <div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th nowrap="nowrap">Date Of Birth</th>
                <th>Unit Institute</th>
                <th>State</th>
                <th>District</th>
                <th>Mobile</th>
                <th nowrap="nowrap">Education Level</th>
                <th nowrap="nowrap">Digital Proficiency</th>
                <th nowrap="nowrap">English Knowledge</th>
                <th nowrap="nowrap">Certification</th>
                <th nowrap="nowrap">Differently Abled</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data as $item)
           
            <tr>
                <td>{{$count}}</td>
                <td nowrap="nowrap"> {{ $item->first_name }}&nbsp;{{ $item->last_name }}</td>
                <td nowrap="nowrap">{{ date('d M, Y', strtotime($item->date_of_birth))}}</td>
                <td nowrap="nowrap">{{ $item->UNIT_INSTITUTE}}</td>
                <td nowrap="nowrap">{{ $item->PROGRAM_STATE}}</td>
                <td nowrap="nowrap">{{ $item->PROGRAM_DISTRICT}}</td>
                <td nowrap="nowrap">{{ $item->primary_phone_number }}</td>
                <td nowrap="nowrap">{{ $item->education_level }}</td>
                <td nowrap="nowrap">{{ $item->digital_proficiency }}</td>
                <td nowrap="nowrap">{{ $item->english_knowledge }}</td>
                @if($item->completion_percent==100)
                <td nowrap="nowrap" style="text-align:center;">
                    <div style="width:20px; height:20px; border-radius:50%; background-color:#22c55e;"></div>
                </td>
                @else
                <td nowrap="nowrap" style="text-align:center;">
                    <div style="width:20px; height:20px; border-radius:50%; background-color:#ffffff; border:1px solid #000000;"></div>
                </td>
                @endif
               
                <td nowrap="nowrap">
                    {{ in_array($item->DIFFRENTLY_ABLED, [0, '0', 'No', null], true) ? 'No' : 'Yes' }}
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
@endsection
