@extends('layouts.default')
@section('title', $title)
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Field Center</span> <br />
            </div>
            <div class="search-box">
                <form method="GET" action="{{ url()->current() }}" class="search-box" style="display: flex; align-items: center; gap: 10px;">
                    @csrf
                    <button class="p-2 bg-blue-600 text-black rounded hover:bg-blue-700">
                    <i class="uil uil-search text-lg"></i>
                    </button>
                    <input type="text" name="search" placeholder="Please type and search">
                </form>
            </div>

        </div>
        </div>
        <div id="content-container">
        </div>
        <!-- <section class="dashboard-partners"> -->
        <div class="dash-content">
            <span class="texttitle">Field Center [{{$response['total']}}]</span>
            <div class="activity">
                <div class="activitybutton">
                    <a  href="{{ route('yuwaahSakhi.export') }}" class="ml-2">
                    <button class="add-partner-btn" style="margin-left: 2px; background-color: brown;">Export Field Center List</button></a>
                    &nbsp;
                    <a href="{{route('admin.yuwaahsakhi.add')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">Add Field Center </button>
                    </a>
                </div>
                    <div class="activity-data">
                        <x-alert />
                    </div>
                    <div class="table-container overflow">
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Field Center ID</th>
                                <th>Program Code</th>
                                <th>Field Center Name</th>
                                <th>Partner</th>
                                <th>Partner Division</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Learner</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($response['data']) && count($response['data']) > 0){ ?>
                            <?php $count=1;
                                  foreach($response['data'] as $item){ //dd($item); ?>
                            <tr>
                                <td>{{$count}}</td>
                                <td nowrap="nowrap">{{$item['sakhiId']}}</td>
                                <td nowrap="nowrap">{{$item['CSC_ID']}}</td>
                                <td nowrap="nowrap">{{$item['Name']}}</td>
                                <td nowrap="nowrap">{{ucwords($item['Partner'])}}</td>
                                <td nowrap="nowrap">{{ucwords($item['PartnerCenter'])}}</td>
                                <td>{{$item['ContactNumber']}}</td>
                                <td>{{$item['Email']}}</td>
                                <td>{{getLearnerCount($item['CSC_ID'])}}</td>
                                <td><?php if($item['Status']=='Active'){ ?>
                                   <span class="badge badge-success">Active</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">InActive</span>
                                <?php } ?>
                                </td>
                                <td>{{$item['CreatedAt']}}</td>
                                
                                <td>
                                    <a href="{{route('admin.yuwaahsakhi.update',['id'=>encryptString($item['id'])])}}"><i class="uil uil-edit" style="color: #27272A; font-size: 15px;"></i></a>
                                    <a href="javascript:void(0);" 
                                        data-route="{{ route('admin.yuwaahsakhi.delete', ['id' => '__ID__']) }}" 
                                        onclick="deleteConfirm('{{ encryptString($item['id']) }}', this.getAttribute('data-route'))">
                                            <i class="uil uil-trash-alt" style="color: #27272A; font-size: 15px;"></i>
                                    </a>
                                    <a href="{{route('admin.yuwaahsakhi.details',['id'=>encryptString($item['id'])])}}"><img src="{{asset('asset/images/view.png')}}" alt="View Doc Image" height="20" width="20"></a>
                                </td>
                            </tr>
                            <?php $count++;} ?>
                            <?php } else{ ?>
                                <tr><td colspan="12">
                                    <div class="alert alert-danger text-center">No Yuwaah Sakhi Found</div>
                                </td></tr>
                            <?php } ?>
                           
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            @if ($response['last_page'] > 1)
            <div class="pagination">
            <table>
    <tr>
        {{-- Previous Page Link --}}
        <td>
            @if ($response['prev_page_url'])
                <a href="{{ $response['prev_page_url'] }}">Prev</a>
            @else
                <span class="disabled">Prev</span>
            @endif
        </td>

        {{-- Page Info --}}
        <td>
            Page {{ $response['current_page'] }} of {{ $response['last_page'] }} 
            | Total: {{ $response['total'] }}
        </td>

        {{-- Next Page Link --}}
        <td>
            @if ($response['next_page_url'])
                <a href="{{ $response['next_page_url'] }}">Next</a>
            @else
                <span class="disabled">Next</span>
            @endif
        </td>
    </tr>
</table>

            </div>
        @endif
        </div>
    </section>

@endsection

    