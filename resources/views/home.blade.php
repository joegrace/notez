@extends('layouts.app')

@section('content')
<div class="container">
    <alert-modal></alert-modal>
    <export-modal></export-modal>
    <router-view></router-view>
    
</div>
@endsection
