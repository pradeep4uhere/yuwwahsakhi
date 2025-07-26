@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Partner Division</span> <br />
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
            <span class="texttitle">All Partner Division [{{$response->total()}}]</span>
            <div class="activity">
                <div class="activitybutton">
                    <a href="{{ route('partnerCenters.export') }}">
                    <button  class="add-partner-btn" id="exportPartnerBtn" style="margin-left: 2px; background-color: brown;">Export Partner Division</button>
                    </a>
                    <a href="{{route('admin.partnercenter.add')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">Add Partner Division</button>
                    </a>
                </div>
                    <div class="activity-data">
                        <x-alert />
                    </div>
                    <div class="table-containers">
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner ID</th>
                                <th>Name</th>
                                <th>Division ID</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($response) && count($response) > 0){ ?>
                            <?php $count=1;
                                  foreach($response as $item){ //dd($item); ?>
                            <tr>
                                <td>{{$count}}</td>
                                <td nowrap="nowrap">{{ isset($item['partner']['partner_id']) ? $item['partner']['partner_id'] : 'No Partner Name' }}</td>
                                <td nowrap="nowrap">{{$item['center_name']}}</td>
                                <td nowrap="nowrap">{{$item['partner_centers_id']}}</td>
                                <td nowrap="nowrap">{{$item['contact_number']}}</td>
                                <td nowrap="nowrap">{{$item['email']}}</td>
                                <td nowrap="nowrap"><?php if($item['status']==1){ ?>
                                   <span class="badge badge-success">Active</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">InActive</span>
                                <?php } ?>
                                </td>
                                <td nowrap="nowrap">{{getdateformate($item['created_at'])}}</td>
                                <td>
                                    <a href="{{route('admin.partnercenter.edit',['id'=>encryptString($item['id'])])}}"><i class="uil uil-edit" style="color: #27272A; font-size: 15px;"></i></a>
                                    <!-- <a href="javascript:void(0);" 
                                        data-route="{{ route('admin.partnercenter.delete', ['id' => '__ID__']) }}" 
                                        onclick="deleteConfirm('{{ encryptString($item['id']) }}', this.getAttribute('data-route'))">
                                            <i class="uil uil-trash-alt" style="color: #27272A; font-size: 15px;"></i>
                                    </a> -->
                                </td>
                            </tr>
                            <?php $count++;}?>
                            <?php } else{ ?>
                                <tr><td colspan="11">
                                    <div class="alert alert-danger text-center">No Partner Center Found</div>
                                </td></tr>
                            <?php } ?>
                           
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            @include('admin.pagination')
        </div>
    </section>

@endsection

    