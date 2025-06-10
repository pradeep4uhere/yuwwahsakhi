@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<style>
  select {
  padding: 10px !important;
}

select option {
  padding: 10px !important;
}
</style>
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
    <div class="dash-content" >
      <span class="texttitle">{{$title}}</span>
      <div class="activity">
          <div class="activitybutton">
            <a href="{{route('admin.yuwaahsakhi.list')}}">
              <button class="add-partner-btn" id="addPartnerBtn">All {{$title}}</button>
              </a>
          </div>
        <form id="yuwaahForm" method="post" action="{{ route('admin.yuwaahsakhi.add') }}" enctype="multipart/form-data" >
          @csrf
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <div class="table-containers">
          <table class="table table-striped table-bordered" style="font-size:12px;">
            <tr>
              <td> <label for="field1"><strong>Name</strong></label></td>
              <td> <label for="field1"><strong>Contact Number</strong></label></td>
            </tr>
            <tr>
              <td>
                <input type="text" name="name" class="form-control" placeholder="Please enter Yuwaah sakhi name"  value="{{ old('name') }}">
              </td>
              <td>
                <input type="number" name="contact_number" class="form-control" placeholder="Please enter contact number" value="{{ old('contact_number') }}">
              </td>
            </tr>
            <tr>
              <td> <label for="field1"><strong>Email</strong></label></td>
              <td> <label for="field1"><strong>Choose Partner</strong></label></td>
            </tr>
            <tr>
              <td><input type="email" name="email" class="form-control" placeholder="Please enter Email" value="{{ old('email') }}"></td>
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
              <td> <label for="field1"><strong>Status</strong></label></td>
            </tr>
            <tr>
              <td>
                <select id="partner_center" class="form-control" name="partner_center_id">
                  <option value="">Choose Partner Center</option>
                </select>
              </td>
              <td>
                <select id="field5" class="form-control" name="status">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
              </td>
            </tr>
            </table>
          <div class="popup-buttons">
            <div class="blank"></div>
            <div class="formbuttons">
              <button type="button" id="discardBtn">Discard</button>
              <button type="submit" id="saveBtn" name="submit">Save Details</button>
            </div>
          </div>
          
        </form>
        </div>
    </section>


@endsection

    