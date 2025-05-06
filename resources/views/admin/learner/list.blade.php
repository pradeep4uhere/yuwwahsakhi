@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Learner</span> <br />
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
            <span class="texttitle">All Learners [{{$response->total()}}]</span>
            <div class="activity">
                <div class="activitybutton">
                    <a href="{{route('admin.learner.export')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">Export Learner</button>
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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date Of Birth</th>
                                <th>Email</th>
                                <th>Gender</th>
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
                                <td>{{$item['first_name']}}</td>
                                <td>{{$item['last_name']}}</td>
                                <td>{{getdateformate($item['date_of_birth'])}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{$item['gender']}}</td>
                                <td><?php if($item['status']=='Active'){ ?>
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

    