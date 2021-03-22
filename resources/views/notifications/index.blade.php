@extends('layouts.app')

@section('title')
    Notifications
@endsection

@section('content')
    <index-notifications
        :values="{{ json_encode($notifications) }}"
        :count="{{ json_encode($count) }}">
    </index-notifications>
@endsection
