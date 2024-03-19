@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('content')
    <a href="{{ route('logout') }}" style="color: white">Logout</a>
@endsection