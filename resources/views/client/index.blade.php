@extends('layout.app')

@section('content')
<div class="row">
  <div class="medium-12 large-12 columns">
    <h4>Clients</h4>
    <div class="medium-2  columns"><a class="button hollow success" href="{{ route('new_client') }}">ADD NEW CLIENT</a></div>


    <table class="stack">
      <thead>
        <tr>
          <th width="200">Name</th>
          <th width="200">Email</th>
          <th width="200">Action</th>
        </tr>
      </thead>
      <tbody>

        @if( $clients->isNotEmpty() )
        @foreach( $clients as $client )
        <tr>
          <td>{{ $client->title }}. {{ $client->name }} {{ $client->last_name }}</td>
          <td>{{ $client->email }}</td>
          <td>
            <a class="hollow button" href="{{ route('show_client', ['id' => $client->id ]) }}">EDIT</a>
            <a class="hollow button warning" href="{{ route('check_room', ['id' => $client->id ]) }}">BOOK A ROOM</a>
            <a class="hollow button warning" href="{{ route('delete_client', ['id' => $client->id ]) }}">DELETE</a>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <th colspan="3">There are no users.</td>
        </tr>
        @endif

      </tbody>
    </table>


  </div>
</div>
@endsection