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
        <div class="dash-content" >
            <span class="texttitle">{{$title}}</span>
            <div class="activity">
              <div class="activitybutton">
                  <a href="{{route('admin.eventcategory.list')}}">
                  <button class="add-partner-btn" id="addPartnerBtn">All Event Category</button>
                  </a>
              </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="yuwaahForm" method="post" style="width:80%" action="{{route('admin.eventmaster.edit',['id'=>encryptString($eventDetails['id'])])}}" enctype="multipart/form-data" >
            @csrf
            <table class="table table-striped table-bordered" style="font-size:12px;">
            <tr>
            <td> <label for="event_type" class="required-field"><strong>Name</strong></label></td>
            <td><label for="event_category" class="required-field"><strong>Event Category</strong></label></td>
            </tr>
            <tr>
            <td>
              
                <select name="event_type" class="form-control ">
                    <option value="">Select an option</option>
                    <?php foreach($evetnTypeList as $item){ ?>
                    <option value="{{$item['id']}}" <?php if($eventDetails['event_type_id']==$item['id']){ ?> selected="selected" <?php } ?>>{{$item['name']}}</option>
                    <?php } ?>
                </select>
              </td>
              <td>
                <input type="text" name="event_category" class="form-control" value="{{ $eventDetails['event_category'] }}">
              </td>
            </tr>
            <tr>
            <td><label for="description" class="required-field"><strong>Brief Description</strong></label></td>
            <td><label for="eligibility" ><strong>Eligibility</strong></label></td>
            </tr>
            <tr>
              <td>
                <input type="text" name="description" class="form-control" value="{{ $eventDetails['description'] }}"/>
              </td>
              <td>
               
                <input type="text" name="eligibility" class="form-control" value="{{ $eventDetails['eligibility'] }}">
              </td>
            </tr>
            <tr>
            <td><label for="fee_per_completed_transaction" class="required-field"><strong>Fee Per Completed Transaction</strong></label></td>
            <td> <label for="date_event_created_in_master" class="required-field"><strong>Event Date</strong></label></td>
            </tr>
            <tr>
              <td>
                <input type="number" step="1" name="fee_per_completed_transaction" class="form-control" value="{{ $eventDetails['fee_per_completed_transaction'] }}">
              </td>
              <td>
                <input type="date" name="date_event_created_in_master" class="form-control" value="{{ $eventDetails['date_event_created_in_master'] }}">
              </td>
            </tr>
            <tr>
            <td><label for="field4" class="required-field"><strong>Document-1 Name</strong></label></td>
            <td> <label for="field4"><strong>Document-2 Name</strong></label></td>
            </tr>
            <tr>
            <td>
              <input type="text" class="form-control" name="document_1" placeholder="Please enter Document 1 Name" value="{{ $eventDetails['document_1'] }}">
              @error('document_1')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </td>
            <td>
            <input type="text" class="form-control" name="document_2" placeholder="Please enter Document 2 Name" value="{{ $eventDetails['document_2'] }}">
            </td>
            </tr>
            <tr>
            <td><label for="field4"><strong>Document-3 Name</strong></label></td>
            <td><label for="field5"><strong>Status</strong></label></td>
            </tr>
            <tr>
            <td>
              <input type="text" class="form-control" name="document_3" placeholder="Please enter Document 3 Name" value="{{ $eventDetails['document_3'] }}">
            </td>
             <td>
                <select id="field5" name="status" class="form-control">
                  <option value="1" <?php if($eventDetails['status']==1){?> selected="selected" <?php } ?>>Active</option>
                  <option value="0" <?php if($eventDetails['status']==0){?> selected="selected" <?php } ?>>InActive</option>
                </select>
             </td>
            </tr>
            <tr style="background-color:#FFF;">
           <td></td>
           <td text-align="right">
           <div class="popup-buttons">
              <button type="button" id="discardBtn" style="border:solid 1px #000; margin-right:5px">Discard</button>
              <button type="submit" id="saveBtn" name="submit">Save Details</button>
            </div>
          </td>
          </tr>
          </div>
        </table>
        </form>
            
        </div>
    </section>

@endsection

    