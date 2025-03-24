@extends('layouts.list')
@section('title', 'Partner Home Page')
@section('content')
@include('partner.menu')

<div class="container">
        <a href="{{route('partner.partnercenter')}}" class="back-link"><i class="fas fa-arrow-left"></i>Back to Partner Center</a>
        <h2>Partner Center Details</h2>
        <div class="section" style="margin-bottom:50px">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Onboard On</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="upper_div">
                            <td>{{$partnerCenterDetails['id']}}</td>
                            <td>{{ $partnerCenterDetails['center_name'] }}</td>
                            <td>{{ $partnerCenterDetails['contact_number'] }}</td>
                            <td>{{ $partnerCenterDetails['email'] }}</td>
                            <td>{{ $partnerCenterDetails['onboard_date'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h2>Associated Yuwaah Sakhi</h2>
        <div class="details">
        <div class="table-container">
        <table>
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Onboard On</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; //dd($data['YuwwahSakhi']);?>
             @foreach ($data as $item)
                <tr>
                    <td>{{$count}}</td>
                    <td>{{ $item['sakhi_id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['contact_number'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['onboard_date'] }}</td>
                    <td>{{ $item['status'] }}</td>
                    <td>{{ $item['created_at'] }}</td>
                    <td><a href="{{route('partner.partnercenter.viewyuwaahsakhi.details',['id'=>encryptString($item['id'])])}}">View Details</a></td>
                </tr>
                <?php $count++; ?>
                @endforeach
            </tbody>
        </table>
            </div>
            <div class="pagination">
            {{ $data['pagination_links'] ?? '' }}
            </div>
        </div>
    </div>
@endsection


