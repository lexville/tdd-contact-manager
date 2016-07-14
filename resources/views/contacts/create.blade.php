@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Create New Contact</h2>
    {!! Form::open(array('route' => 'contacts.store', 'method' => 'POST')) !!}

    <div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
    {!! Form::label('mobile_number', 'Mobile Number:', ['class' => 'control-label']) !!}
    {!! Form::text('mobile_number', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Create New Contacts', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
@stop
