@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Placement Partner</span> <br />
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
            <span class="texttitle">Placement Partners [{{$response->total()}}]</span>
            <div class="activity">
                <div class="activitybutton">
                   <a href="{{ route('partner.users.export') }}" >
                    <button class="add-partner-btn" id="addPartnerBtn" style="margin-left: 2px; background-color: brown;">Placement Partner Export</button>
                    </a>&nbsp;&nbsp;
                    <a href="{{route('admin.pppartner.add')}}" style="margin-right:5px">
                    <button class="add-partner-btn" id="addPartnerBtn">Add New Placement Partner</button>
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
                                <th nowrap="nowrap">PP Code</th>
                                <th nowrap="nowrap">Name</th>
                                <th nowrap="nowrap">Contact Number</th>
                                <th nowrap="nowrap">Email</th>
                                <th nowrap="nowrap">Status</th>
                                <th nowrap="nowrap">Created On</th>
                                <th nowrap="nowrap">Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php if(isset($response) && count($response) > 0){ ?>
                            <?php $count=1;
                                  foreach($response as $item){ //dd($item); ?>
                            <tr>
                                <td>{{$count}}</td>
                                <td nowrap="nowrap">{{$item['pp_code']}}</td>
                                <td nowrap="nowrap">{{$item['name']}}</td>
                                <td nowrap="nowrap">{{$item['phone']}}</td>
                                <td nowrap="nowrap">{{$item['email']}}</td>
                                <td nowrap="nowrap"><?php if($item['status']==1){ ?>
                                   <span class="badge badge-success">Active</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">InActive</span>
                                <?php } ?>
                                </td>
                                <td nowrap="nowrap">{{getformateDate($item['created_at'],'d M, Y H:i:s A')}}</td>
                                <td nowrap="nowrap">
                                    <a href="{{route('admin.pppartner.edit',['id'=>encryptString($item['id'])])}}"><i class="uil uil-edit" style="color: #27272A; font-size: 15px;"></i></a>
                                    <!-- <a href="javascript:void(0);" 
                                        data-route="{{ route('admin.partner.delete', ['id' => '__ID__']) }}" 
                                        onclick="deleteConfirm('{{ encryptString($item['id']) }}', this.getAttribute('data-route'))">
                                            <i class="uil uil-trash-alt" style="color: #27272A; font-size: 15px;"></i>
                                    </a> -->
                                </td>
                            </tr>
                            <?php $count++;} ?>
                            <?php } else{ ?>
                                <tr><td colspan="11">
                                    <div class="alert alert-danger text-center">No Placement Partner Found</div>
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

    