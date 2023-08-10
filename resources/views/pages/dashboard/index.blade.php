@extends('layouts.app')

@section('page_title')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" ><a href="{{ route('dashboard') }}">dashboard</a></li>
        </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> Users - {{ $users }}</h5>
                        <p>Users available.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Activities - {{ $activities}}</h5>
                    <p>Activities available.</p>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection
