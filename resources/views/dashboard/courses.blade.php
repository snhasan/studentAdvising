@extends('layouts.dashboard')

@section('content')
    <courses-component :profile="{{ Auth::user()}}"></courses-component>


@endsection
