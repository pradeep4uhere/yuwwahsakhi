@extends('layouts.default')
@section('title', $title)
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > {{$title}}</span> <br />
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
            <span class="texttitle">{{$title}}</span>
            <div class="activity">
                <div class="activitybutton">
                    <a href="{{route('admin.promotions.add')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">Add {{$title}}</button>
                    </a>
                </div>
                    <div class="activity-data">
                        <x-alert />
                    </div>
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Thumbnail</th>
                                <th>Promotional descriptions</th>
                                <th>Attached File</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($response['data']) && count($response['data']) > 0){ ?>
                            <?php $count=1;
                                  foreach($response['data'] as $item){ //dd($item); ?>
                            <tr>
                                <td>{{$count}}</td>
                                <td><img src="{{$item['thumbnail']}}" alt="img" height="50" width="100"></td>
                                <td>{{$item['promotional_descriptions']}}</td>
                                <td nowrap="nowrap"><a href="{{$item['material_file']}}">Attached File</a></td>
                                <td><?php if($item['status']==1){ ?>
                                   <span class="badge badge-success">Active</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">InActive</span>
                                <?php } ?>
                                </td>
                                <td nowrap="nowrap">{{$item['created_at']}}</td>
                                <td>
                                    <a href="{{route('admin.promotions.update',['id'=>encryptString($item['id'])])}}"><i class="uil uil-edit" style="color: #27272A; font-size: 15px;"></i></a>
                                    <a href="javascript:void(0);" 
                                        data-route="{{ route('admin.promotions.delete', ['id' => '__ID__']) }}" 
                                        onclick="deleteConfirm('{{ encryptString($item['id']) }}', this.getAttribute('data-route'))">
                                            <i class="uil uil-trash-alt" style="color: #27272A; font-size: 15px;"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $count++;} ?>
                            <?php } else{ ?>
                                <tr><td colspan="11">
                                    <div class="alert alert-danger text-center">No Opportunity Found</div>
                                </td></tr>
                            <?php } ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($response['last_page'] > 1)
            <div class="pagination">
                <table>
                    <tr>
                        {{-- Previous Page Link --}}
                        <td>
                            @if ($response['prev_page_url'])
                                <a href="{{ $response['prev_page_url'] }}"><i class="uil uil-angle-left"></i></a>
                            @else
                                <span class="disabled"><i class="uil uil-angle-left"></i></span>
                            @endif
                        </td>

                        {{-- Page Numbers --}}
                        @for ($page = 1; $page <= $response['last_page']; $page++)
                            <td class="page-number @if ($response['current_page'] == $page) active @endif">
                                <a href="{{ url()->current() . '?page=' . $page }}">{{ $page }}</a>
                            </td>
                        @endfor

                        {{-- Next Page Link --}}
                        <td>
                            @if ($response['next_page_url'])
                                <a href="{{ $response['next_page_url'] }}"><i class="uil uil-angle-right"></i></a>
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

    