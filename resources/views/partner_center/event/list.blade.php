@extends('layouts.list')
@section('title', 'Partner Center Event')
@section('content')
@include('partner_center.menu')
<div class="container">
        <h1>Event List</h1>
        <div class="table-container">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Event Type</th>
                <th>Event Category</th>
                <th>Description</th>
                <th>Eligibility</th>
                <th>Fee Per Transaction</th>
                <th>Documents</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data as $item)
            
            <tr>
                <td>{{$count}}</td>
                <td>{{ $item['event_type'] }}</td>
                <td>{{ $item['event_category'] }}</td>
                <td>{{ $item['description'] }}</td>
                <td>{{ $item['eligibility'] }}</td>
                <td>{{ $item['fee_per_completed_transaction'] }}</td>
                <td>{{ $item['date_event_created_in_master'] }}</td>
                <td>
                    {{ $item['document_1'] }}<br/>
                    {{ $item['document_2'] }}<br/>
                    {{ $item['document_3'] }}<br/>
                </td>
                <td>
                    <a href="#" class="btn btn-primary btn-sm">View</a>
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


