@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Partner</span> <br />
            </div>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Please type and search">
            </div>

        </div>
        </div>
        <div id="content-container">
        </div>
        <!-- <section class="dashboard-partners"> -->
        <div class="dash-content">
            <span class="texttitle">Partners</span>
            <div class="activity">
                <div class="activitybutton">
                   <a href="{{route('partners.export')}}" >
                    <button class="add-partner-btn" id="addPartnerBtn">Partner Export</button>
                    </a>&nbsp;&nbsp;
                    <a href="{{route('admin.partner.add')}}" style="margin-right:5px">
                    <button class="add-partner-btn" id="addPartnerBtn">Add Partner</button>
                    </a>
                   
                </div>
                    <div class="activity-data">
                        <x-alert />
                    </div>
                    <div style="width=100%;overflow-x: auto;">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner ID</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Block</th>
                                <th>Onboarded on</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php if(isset($response) && count($response) > 0){ ?>
                            <?php $count=1;
                                  foreach($response as $item){ //dd($item); ?>
                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$item['partner_id']}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['contact_number']}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{ optional($item->state)->name ?? 'N/A' }}</td>
                                <td>{{ optional($item->district)->name ?? 'N/A' }}</td>
                                <td>{{ optional($item->block)->name ?? 'N/A' }}</td>
                                <td>{{$item['onboard_date']}}</td>
                                <td><?php if($item['status']==1){ ?>
                                   <span class="badge badge-success">Active</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">InActive</span>
                                <?php } ?>
                                </td>
                                <td>{{$item['created_at']}}</td>
                                <td>
                                    <a href="{{route('admin.partner.edit',['id'=>encryptString($item['id'])])}}"><i class="uil uil-edit" style="color: #27272A; font-size: 15px;"></i></a>
                                    <a href="javascript:void(0);" 
                                        data-route="{{ route('admin.partner.delete', ['id' => '__ID__']) }}" 
                                        onclick="deleteConfirm('{{ encryptString($item['id']) }}', this.getAttribute('data-route'))">
                                            <i class="uil uil-trash-alt" style="color: #27272A; font-size: 15px;"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $count++;} ?>
                            <?php } else{ ?>
                                <tr><td colspan="11">
                                    <div class="alert alert-danger text-center">No Partner Found</div>
                                </td></tr>
                            <?php } ?>
                           
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            @if ($response->lastPage() > 1)
                <!-- Pagination code start -->
                <div class="pagination">
                    <table>
                        <tr>
                            {{-- Previous Page Link --}}
                            <td>
                                @if ($response->onFirstPage())
                                    <span class="disabled"><i class="uil uil-angle-left"></i></span>
                                @else
                                    <a href="{{ $response->previousPageUrl() }}"><i class="uil uil-angle-left"></i></a>
                                @endif
                            </td>

                            {{-- Current Page --}}
                            <td class="current-page">
                                <span>{{ $response->currentPage() }}</span>
                            </td>

                            {{-- Next Page Link --}}
                            <td>
                                @if ($response->hasMorePages())
                                    <a href="{{ $response->nextPageUrl() }}"><i class="uil uil-angle-right"></i></a>
                                @else
                                    <span class="disabled"><i class="uil uil-angle-right"></i></span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        </div>
    </section>

@endsection

    