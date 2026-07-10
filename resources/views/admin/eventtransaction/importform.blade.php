@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard -> Import ->  Event Transactions</span> <br />
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
            <span class="texttitle">Import Event Transactions</span>
            <div class="activity">
               
                <div class="activity-data">

                  @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                            <br>
                            <strong>Inserted:</strong> {{ session('inserted_count') }}
                            <br>
                            <strong>Failed:</strong> {{ session('failed_count') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('failed_rows'))
    <div class="alert alert-warning">
        <strong>Failed Rows:</strong>
        <ul>
            @foreach(session('failed_rows') as $row)
                <li>Row {{ $row['row'] }} - {{ $row['error'] }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    </div>
                    <div style="width=100%;overflow-x: auto;">
                    <form action="{{ route('admin.importeventtransaction.action') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-striped table-bordered" style="font-size:12px;">
                        <tr>
                        <td> <label for="field1"><strong>Choose Partner</strong></label></td>
                        <td>
                        <select id="partner" name="partner_id" class="form-control">
                            <option value="">Choose Partner</option>
                            <?php foreach($partnerList as $item111){ ?>
                                <option value="{{$item111['id']}}">{{$item111['name']}}</option>
                            <?php } ?>
                        </select>
                        </td>
                        </tr>
                        <tr>
                        <td> <label for="field1"><strong>Choose Partner Center</strong></label></td>
                        <td>
                            <select id="partner_center" class="form-control" name="partner_center_id">
                            <option value="">Choose Partner Center</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td> <label for="field1"><strong>Status</strong></label></td>
                        <td>
                            <select id="field5" class="form-control" name="status">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td>  <label for="field4">Choose Event Transaction CSV File</label>
                        <input type="file" name="file" id="fileInput"></td>
                        <td>
                        <button type="submit" id="saveBtn" name="submit">Import Data</button>
                        </td>
                        </tr>
                    </table>
                </form>
                <!-- Progress Bar -->
                <progress id="progress-bar" value="10" max="100"></progress>
                <!-- Add a loading spinner or some other UI element to indicate the process -->
                <div id="loadingSpinner" style="display:none;">Importing...</div>
                </div>
            </div>
         
        </div>
    </section>


@endsection

    