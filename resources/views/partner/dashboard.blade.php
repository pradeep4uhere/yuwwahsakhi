@extends('layouts.partner')
@section('title', 'Partner Home Page')
@section('content')
@include('partner.menu')
<style>
    body{
        background: #f4f7fb;
        font-family: 'Poppins', sans-serif;
    }

    .welcome-wrapper{
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
    }

    .welcome-card{
        width: 100%;
        max-width: 1150px;
        background: #ffffff;
        border-radius: 30px;
        padding: 60px;
        box-shadow: 0 15px 50px rgba(15, 23, 42, 0.08);
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before{
        content: '';
        position: absolute;
        width: 280px;
        height: 280px;
        background: rgba(99,102,241,0.08);
        border-radius: 50%;
        top: -120px;
        right: -100px;
    }

    .welcome-card::after{
        content: '';
        position: absolute;
        width: 220px;
        height: 220px;
        background: rgba(168,85,247,0.08);
        border-radius: 50%;
        bottom: -100px;
        left: -80px;
    }

    .welcome-content{
        position: relative;
        z-index: 2;
    }

    .welcome-badge{
        display: inline-block;
        background: #eef2ff;
        color: #4f46e5;
        padding: 10px 22px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 22px;
    }

    .welcome-title{
        font-size: 52px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 18px;
        line-height: 1.2;
    }

    .welcome-title span{
        color: #6366f1;
    }

    .welcome-text{
        font-size: 18px;
        color: #64748b;
        line-height: 1.8;
        margin-bottom: 35px;
    }

    .welcome-btn{
        display: inline-block;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        padding: 14px 34px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s ease;
        box-shadow: 0 10px 25px rgba(99,102,241,0.25);
    }

    .welcome-btn:hover{
        transform: translateY(-3px);
        color: #fff;
    }

    .image-section{
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .welcome-image{
        width: 100%;
        max-width: 420px;
        display: block;
        margin: 0 auto;
        animation: floatImage 4s ease-in-out infinite;
    }

    @keyframes floatImage{
        0%{
            transform: translateY(0px);
        }
        50%{
            transform: translateY(-12px);
        }
        100%{
            transform: translateY(0px);
        }
    }

    @media(max-width: 768px){

        .welcome-card{
            padding: 35px 25px;
            text-align: center;
        }

        .welcome-title{
            font-size: 36px;
        }

        .welcome-text{
            font-size: 16px;
        }

        .image-section{
            margin-top: 40px;
        }

        .welcome-image{
            max-width: 300px;
        }
    }
</style>

<div class="welcome-wrapper">
    <div class="welcome-card">

        <div class="row align-items-center welcome-content">

            <div class="col-lg-6">
                <div class="welcome-badge">
                    ✨ Partner Account
                </div>

                <h1 class="welcome-title">
                    Welcome Back, <span>Partner</span>
                </h1>

                <p class="welcome-text">
                    Access your  account to manage learners, monitor event reports, track Field Agent Activities, and streamline your daily operations efficiently.
                </p>

                <a href="{{route('partner.event')}}" class="welcome-btn">
                    Explore Events
                </a>
            </div>

            <div class="col-lg-6 image-section">
                <img src="{{ asset('asset/images/welcome.svg') }}" 
                     alt="Welcome Image"
                     class="welcome-image">
            </div>

        </div>

    </div>
</div>
@endsection
