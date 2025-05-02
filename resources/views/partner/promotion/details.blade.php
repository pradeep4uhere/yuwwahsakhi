@extends('layouts.list')
@section('title', 'Partner Promotion Details Page')
@section('content')
@include('partner.menu')
<!-- In your layouts.app head section -->
<style>
        /* Base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Montserrat', sans-serif;
    color: #333;
    line-height: 1.5;
}
.header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 20px 20px;
      /* border-bottom: 1px solid #ddd; */
    }


    .header-left {
      display: flex;
      align-items: center;
      gap: 50px;
    }

    .header img {
      height: 70px;
      /* margin-right: 20px; */
      top: 10px;
      /* left: 30px; */
      width: 130px;
    }

    .header .nav {
      display: flex;
      gap: 10px;
      /* margin-top: 15px; */
    }

    .header .nav a {
      text-decoration: none;
      /* color: White; */
      border: 1px solid #ddd;
      border-radius: 10px;
      size: 12px;
      width: fixed 100px;
      height: fixed 30px;
      padding-top: 5px;
      padding-right: 22px;
      padding-bottom: 5px;
      padding-left: 22px;
      font-weight: 400;
      line-height: 20px;
      gap: 10px;
      
      letter-spacing: -2%;

    }

    .header .nav a:hover {
      background-color: #28388F;
      color: #fff;
      font-weight: 600;


    }

    .header .icons {
  display: flex;
  align-items: center;
  gap: 5px; /* Adjust this value as needed */
  left: 3rem;
}

.icons img {
  width: 60px; /* Adjust width for consistency */
  height: 60px; /* Adjust height */
}

    /* Wrapper for Icons and Hamburger */
    .header-right {
      display: flex;
      /* gap: 10px; */
      align-items: center;
    }

    /* Hamburger Menu */
    .hamburger {
      display: none;
      /* Hidden on desktop */
      font-size: 24px;
      cursor: pointer;
      background: none;
      border: none;
    }

    /* Drawer (Mobile Navigation) */
    .drawer {
      display: none;
      flex-direction: column;
      background: #fff;
      /* color: #fff; */
      /* Change background to white for a clean look */
      border-left: 2px solid #ddd;
      /* Add left border for separation */
      position: fixed;
      top: 70;
      /* bottom: 0; */
      width: 100%;
      /* Define fixed width for the drawer */
      height: auto;
      z-index: 1000;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    /* When the drawer is active */
    .drawer.active {
      display: flex;
      background-color: #fff;
      /* Show drawer when active */
    }

    .drawer a {
      text-align: center;
      padding: 10px;
      text-decoration: none;
      /* color: white; */

    }

    .drawer a:last-child {
      border-bottom: none;
    }
  

   
    .active{
      color: white;
      background-color: #28388F;
    }

    /* Mobile View Adjustments */
    @media (max-width: 1064px) {
      .header .nav {
        display: none;
        /* Hide desktop nav */
      }

      .header-right {
        display: flex;
        justify-content: flex-end;
        align-items: center;
      }

      .hamburger {
        display: block;
        /* Show hamburger icon */
      }

      /* Selected State */



    }   


.container {
    max-width: 95%;
    margin: 20px auto;
    /* padding: 24px; */
}

/* Back button */
.back-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #000000;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .back-link svg {
            width: 20px;
            height: 20px;
        }

/* Learner Info */
.learner-info {
    margin-bottom: 32px;
}

.learner-info h2 {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 16px;
    color: #000000;
    line-height: 19.5px;
}

.info-container {
    display: flex;
    align-items: center;
    gap: 32px;
    font-size: 14px;
    color: #666;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 20px;
    color: #28388F;
    font-weight: 500;
}

.info-value {
    color: #333;
}

.contact-buttons {
    display: flex;
    gap: 16px;
}

.icon-button {
    border: none;
    background: none;
    padding: 8px;
    cursor: pointer;
    border-radius: 4px;
}

.icon-button:hover {
    background-color: #f5f5f5;
}

/* Tabs */

.tabs{
    border: 1px solid #D2D5DA;
   
    padding: 1rem;
}
.tab-list {
    display: flex;
    /* border-bottom: 1px solid #e5e7eb; */
    margin-bottom: 24px;
}

.tab-button {
    border: none;
    background: none;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    color: #666;
}

.tab-button a{
    color: #A7A7A7;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
}

.tab_active a{
            color: #28388F;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
        }

.tab-button.active {
    border-bottom-color: #28388F;
    color: #28388F;
    padding: 0.5rem;
    font-weight: 400;
    text-decoration: none;
}

/* Stats */
.stats {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
}

.stat-card {
    background-color: #f9fafb;
    padding: 12px 16px;
    border-radius: 4px;
}

.stat-label {
    font-size: 14px;
    color: #666;
}

.stat-value1 {
    font-size: 24px;
    font-weight: 600;
    color: #05A7D1;
    margin-left: 1rem;
}
.stat-value2 {
    font-size: 24px;
    font-weight: 600;
    color:#28388F;
    margin-left: 1rem;
}

/* Table */
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

th {
    text-align: left;
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    color: #28388F;
    font-weight: 500;
}

td {

    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
}

.view-doc {
    color: #2563eb;
    text-decoration: none;
}

.view-doc:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 768px) {
    .info-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .stats {
        flex-direction: column;
    }

    .table-container {
        margin: 0 -24px;
    }

    table {
        font-size: 13px;
    }

    td, th {
        padding: 8px;
    }
}
</style>
<div class="container">
        <!-- Learner Info -->
        <div class="learner-info">
            <h2>Promotion Detail</h2>
           
            <div class="info-container">
                <div class="info-item">
                    <span class="info-value">{{$promotionDetails['promotional_descriptions']}}</span>
                </div>
            </div>
        </div>
        <!-- Stats -->
       

        <div class="col-md-12">
        <div class="card">
        <div class="card-header">More Details</div>
        <div class="card-body">
        <div  style="margin-bottom:20px">
            <span>File</span>
            <?php $fileArr = json_decode($promotionDetails['material_file'],true);?>
            <span class="info-value"><a href="{{asset('storage/promotion/'.$fileArr['file'])}}" target="_blank">Material File Uploaded</a></span>
        </div>
       
        <div  style="margin-bottom:20px">
        <p>Thumbnail</p>
        <img src="{{asset('storage/promotion/'.$promotionDetails['thumbnail'])}}" width="100%" height="400px"/>
        </div>
       
        <div  style="margin-bottom:20px">
        <p>Banner</p>
        <img src="{{asset('storage/promotion/'.$promotionDetails['banner'])}}" width="100%" height="400px"/>
        </div>
        
        <div  style="margin-bottom:20px">
        <p>Status</p>
        {{$promotionDetails['status']}}
        </div>
        
        <div  style="margin-bottom:20px">
        <p>Created On</p>
        {{$promotionDetails['created_at']}}
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
@endsection

