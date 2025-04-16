@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Admin Dashboard</h4>
                                    <p>Welcome, {{ auth()->user()->nama }}!</p>
                                    <p>Use the sidebar to manage users and roles.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection