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
                    <button class="add-partner-btn" id="addPartnerBtn">All Yuwaah Sakhi</button>
                    </a>
                </div>
              @if(!empty($errors) && ($errors!=null))
              <div class="alert alert-danger">
                  @foreach ($errors as $field => $fieldErrors)
                          @foreach ($fieldErrors as $error)
                              <small>{{ ucfirst($field) }}: {{ $error }}</small><br/>
                          @endforeach
                  @endforeach
              </div>
              @endif
              @if(isset($success) && ($success!=null))
              <div class="alert alert-success">
                  <small>{{$success}}</small>
              </div>
              @endif

          <?php //dd($yuwaahsakhi);?>
          <form id="yuwaahForm" method="post" action="{{ route('admin.yuwaahsakhi.update', ['id'=>encryptString($yuwaahsakhi->id)])}}" enctype="multipart/form-data" >
          @csrf
          @method('PUT')
          <table class="table table-striped table-bordered" style="font-size:12px;">
            <tr>
              <td> <label for="field1"><strong>Name</strong></label></td>
              <td> <label for="field1"><strong>Contact Number</strong></label></td>
            </tr>
            <tr>
              <td>
                <input type="text" name="name" class="form-control" placeholder="Please enter Yuwaah sakhi name" value="{{ $yuwaahsakhi['name'] }}">
              </td>
              <td>
                <input type="number" name="contact_number" class="form-control" placeholder="Please enter contact number" value="{{ $yuwaahsakhi['contact_number'] }}">
              </td>
            </tr>
            <tr>
              <td> <label for="field1"><strong>Email</strong></label></td>
              <td> <label for="field1"><strong>Choose Partner</strong></label></td>
            </tr>
            <tr>
              <td><input type="email" name="email" class="form-control" placeholder="Please enter Email" value="{{ $yuwaahsakhi['email'] }}"></td>
              <td>
              <select id="partner" name="partner_id" class="form-control">
                <option value="">Choose Partner</option>
               <?php foreach($partnerList as $item111){ ?>
                        <option value="{{$item111['id']}}" <?php if($item111['id'] == $yuwaahsakhi['partner_id']){  ?> selected <?php } ?>>{{$item111['name']}}</option>
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
                  <option value="{{ $yuwaahsakhi['partner_center_id'] ?? '' }}" selected="selected">
                      {{ optional($yuwaahsakhi['PartnerCenter'])->center_name ?? 'N/A' }}
                  </option>
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
              <input type="hidden" name="id" value="{{$yuwaahsakhi['id']}}">
              <button type="submit" id="saveBtn" name="submit">Save Details</button>
            </div>
          </div>
          
        </form>
        </div>
        </div>
    </section>

@endsection

    