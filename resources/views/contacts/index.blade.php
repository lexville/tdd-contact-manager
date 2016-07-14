@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead>
              <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
              </tr>
        </thead>
        <tbody>
            @foreach($userContacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->mobile_number }}</td>
                <td><a href="{{ route('contacts.show',$contact->id) }}">Show</a></td>
                <td><a href="{{ route('contacts.edit',$contact->id) }}">Edit</a></td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route'=>['contacts.destroy', $contact->id]]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {{ $userContacts->render() }}
</div>
@stop
