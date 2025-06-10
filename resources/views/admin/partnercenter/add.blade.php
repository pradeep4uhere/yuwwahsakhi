@extends('layouts.default')
@section('title', 'Partner List')
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
        <div class="dash-content" >
            <span class="texttitle">{{$title}}</span>
            <div class="activity">
                <div class="activitybutton">
                    <a href="{{route('admin.partnercenter')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">All Partner Center</button>
                    </a>
                </div>
                @if (!empty($errors))
                <div class="alert alert-danger">
                    @foreach ($errors as $field => $fieldErrors)
                        @if(is_array($fieldErrors))
                            @foreach ($fieldErrors as $error)
                                <small>{{ ucfirst($field) }}: {{ $error }}</small><br/>
                            @endforeach
                        @else
                            <small>{{ ucfirst($field) }}: {{ $fieldErrors }}</small><br/>
                        @endif
                    @endforeach
                </div>
            @endif

            @if (!empty($success))
                <div class="alert alert-success">
                    <small>{{ $success }}</small>
                </div>
            @endif


            <div class="table-containers">
            <form id="yuwaahForm" method="post" style="width:70%" action="{{route('admin.partnercenter.add')}}">
            @csrf
            <table class="table table-striped table-bordered" style="font-size:12px;">
            <tr>
              <td> <label for="field1"><strong>Partner Center Name</strong></label></td>
              <td> <label for="field1"><strong>Partner Center ID</strong></label></td>
            </tr>
            <tr>
              <td>
                    <input type="text" class="form-control" name="center_name" placeholder="Please enter Partner Name" value="{{old('name')}}">
                </td> 
                <td>
                    <input type="text" class="form-control" name="partner_centers_id" placeholder="Please enter Partner Id" value="{{old('partner_id')}}">
                </td> 
              </tr>
              <tr>
              <td> <label for="field3"><strong>Contact Number</strong></label></td>
              <td>  <label for="field5"><strong>Status</strong></label></td>
              </tr>
              <tr>
              <td> 
              <div class="input-container">
                <input type="text" name="contact_number" placeholder="Please Contact Number" value="{{old('contact_number')}}">
              </div>
              </td>
              <td> 
              
                <select id="field5" name="status" class="form-control">
                  <option value="1" >Active</option>
                  <option value="0">InActive</option>
                </select>
              </td>
              </tr>
              <tr>
              <td> <label for="field3"><strong>Login ID</strong></label></td>
              <td>  <label for="field5"><strong>Password</strong></label></td>
              </tr>
              <tr>
              <td>
                <div class="input-container">
                  <input type="email" name="email" placeholder="Please enter Email Address" value="{{old('email')}}">
                </div>
              </td>
              <td><input type="text" name="password" class="form-control" placeholder="Please enter password"></td>
              </tr>
            </div>
            <tr>
              <td>
              <label for="field5"><strong>Choose Partner</strong></label>
              </td>
              <td> <select id="field5" name="partner_id" class="form-control">
                <?php foreach($partnerList as $item){ ?>
                  <option value="{{$item['id']}}">{{$item['name']}}</option>
                <?php } ?>
              </select></td>
              </tr>
              <tr>
              
              <td colspan="2"><div class="popup-buttons">
              <div class="blank"></div>
              <div class="formbuttons">
                <button type="button" id="discardBtn">Discard</button>
                <button type="submit" id="saveBtn" name="submit">Save Details</button>
              </div>
            </div></td>
              </tr>

          
          </table>
          </form>
        </div>   



            
        </div>
    </section>

@endsection

    