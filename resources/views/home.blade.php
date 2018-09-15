@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Notes List</div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Header</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
