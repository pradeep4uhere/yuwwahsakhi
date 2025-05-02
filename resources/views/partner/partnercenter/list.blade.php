@extends('layouts.list')
@section('title', 'Partner Home Page')
@section('content')
@include('partner.menu')
<div class="container">
        <h1>Partner Centers [{{count($data['data'])}}]</h1>
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Onboard On</th>
                <th>Ys Associated</th>
                <th>Status</th>
                <th>Created</th>
                
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data['data'] as $item)
            <tr>
                <td>{{$count}}</td>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['center_name'] }}</td>
                <td>{{ $item['contact_number'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ getformateDate($item['onboard_date'],'d M, Y') }}</td>
                <td><a href="{{route('partner.partnercenter.viewyuwaahsakhi',['id'=>encryptString($item['id'])])}}">{{$item['yuwwah_sakhi_count']}}</a></td>
                <td>{{ ($item['status']==1)?'Active':'InActive' }}</td>
                <td>{{ getformateDate($item['created_at'],'d M, Y H:i:s a') }}</td>
               
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
            <div class="pagination">
            {{ $data['pagination_links'] ?? '' }}
            </div>
      
    </div>
    <!-- Pagination -->
</div>
@endsection


