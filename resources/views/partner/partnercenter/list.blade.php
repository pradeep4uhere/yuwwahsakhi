@extends('layouts.list')
@section('title', 'Partner Home Page')
@section('content')
@include('partner.menu')
<div class="container">
        <h1>Partner Center Details</h1>
        <div class="table-container">
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
                <th>Other</th>
                
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
               
                <td>{{ $item['onboard_date'] }}</td>
                <td><a href="{{route('partner.partnercenter.viewyuwaahsakhi',['id'=>encryptString($item['id'])])}}">{{$item['yuwwah_sakhi_count']}}</a></td>
                <td>NA</td>
                <td>
                    <!-- <a href="{{route('partner.partnercenter.edit',['id'=>$item['id']])}}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form> -->
                </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
            <div class="pagination">
            {{ $data['pagination_links'] ?? '' }}
            </div>
        </div>
    </div>
    <!-- Pagination -->
</div>
@endsection


