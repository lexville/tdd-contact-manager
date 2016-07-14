@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img class="media-object userProfileImage" src="{{ auth()->user()->getAvatar() }}">
            </div>
            <div class="col-sm-8">
                <h4>Name: {{ $contact->name }}</h4>
                <h4>Email: {{ $contact->email }}</h4>
                <h4>Mobile Number : {{ $contact->mobile_number }}</h4>
                <a class="btn btn-primary" href="{{ route('contacts.index') }}">Go Back</a>
            </div>
        </div>
    </div>
@stop
