@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<style>
 table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

td {
    padding: 15px;
    text-align: center;
    vertical-align: top;
}

.popup-grid-img {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.input {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.input img {
    width: 200px;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out;
}

.input img:hover {
    transform: scale(1.05);
}

button.delete-banner {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s;
    width: 100%;
    max-width: 120px;
}

button.delete-banner:hover {
    background-color: #c0392b;
}

/* Grid layout for images */
.banner-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* 4 columns, adjusts for smaller screens */
    gap: 15px;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

@media (max-width: 768px) {
    .banner-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns for medium screens */
    }
}

@media (max-width: 480px) {
    .banner-grid {
        grid-template-columns: repeat(1, 1fr); /* 1 column for small screens */
    }
}
</style>
<!-- Include CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<section class="dashboard">
    <div class="top">
        <div class="title">
            <span class="">Dashboard > YuthHub Partner App Setting</span> <br />
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
      <span class="texttitle">YuthHub Partner App Homepage Setting</span>
      <div class="activity">
      <form id="yuwaahForm" method="post" action="{{ route('admin.yuwaahsakhi.homepage.setting') }}" enctype="multipart/form-data" >
          @csrf
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
          <div class="popup-grid">
            <div class="input-container">
              <label for="field1">{{__('Homepage Title')}}</label>
              <input type="text" name="home_page_title" placeholder="Enter Homepage Title" value="{{ $setting['home_page_title'] }}">
            </div>
          </div>
          <div class="input-container">
              <label for="field1">{{__('description')}}</label>
              <textarea name="description" rows="10" id="editor" class="form-control">{!! $setting['description']!!}</textarea>
          </div>
          <div class="popup-grid">
            <div class="input-container">
              <label for="field1">{{__('Home Page Banner Tipe')}}</label>
              <select id="field5" name="home_page_banner_type" style="height: 40px;">
                  <option value="1" {{ isset($setting['home_page_banner_type']) && $setting['home_page_banner_type'] == 1 ? 'selected' : '' }}>Single Banner</option>
                  <option value="2" {{ isset($setting['home_page_banner_type']) && $setting['home_page_banner_type'] == 2 ? 'selected' : '' }}>Slider Banner</option>
                  <option value="3" {{ isset($setting['home_page_banner_type']) && $setting['home_page_banner_type'] == 3 ? 'selected' : '' }}>YouTube Embedded Video</option>
                  <option value="4" {{ isset($setting['home_page_banner_type']) && $setting['home_page_banner_type'] == 4 ? 'selected' : '' }}>Other</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field1">{{__('You Tube URL')}}</label>
              <input type="text" name="youtube_url"   value="{!!$setting['youtube_url']!!}">
            </div>
            
            <div class="input-container">
              <label for="field5">{{ __('Banner Images') }}</label>
              <input type="file" name="banners[]" multiple placeholder="Choose Multiple Banner Images"/>
          </div>
            
            <div class="popup-buttons">
            <div class="blank"></div>
            <div class="formbuttons">
              <button type="button" id="discardBtn">Discard</button>
              <button type="submit" id="saveBtn" name="submit">Save Details</button>
            </div>
          </div>
          </div>
        </form>
        </div>
        <br/>
        <p><strong>Uploaded Banner<strong></p>
        <div class="input-container">
        <div id="success-message" style="display: none; background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
        </div>
        @if(count($bannerArr) > 0)
            <table>
                @foreach(array_chunk($bannerArr, 4) as $bannerRow) {{-- Splitting into rows of 4 --}}
                    <tr>
                        @foreach($bannerRow as $banner)
                            <td>
                                <div class="popup-grid-img">
                                    <div class="input">
                                        <img src="{{ asset('storage/'.$banner) }}" alt="Banner Image" 
                                            style="width: 300px; height: 200px; border-radius: 10px; margin-top: 10px;">
                                        <button type="button" class="delete-banner" data-path="{{ $banner }}">Delete</button>
                                    </div>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        @endif
        </div>


        <p><strong>Uploaded You Tube<strong></p>
        @if(!empty($setting['youtube_url']))
        <div class="youtube-container">
        <iframe  width="100%"  height="315" src="{{getYouTubeVideoId($setting['youtube_url'])}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    @endif
    </section>

   

    <script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection

    