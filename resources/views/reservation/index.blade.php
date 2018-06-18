@extends('layout.app')

@section('content')
    <div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Reservations</h4>

        <table class="stack">
          <thead>
            <tr>
              <th width="200">ROOM</th>
              <th width="200">Name</th>
              <th width="200">DATES</th>
              <th width="200">Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach($reservations as $reservation)
              <tr>
                <td>{{ $reservation->room->name }}</td>
                <td>{{ $reservation->client->title }}. {{ $reservation->client->name }} {{ $reservation->client->last_name }}</td>
                <td>{{ $reservation->date_in }} - {{ $reservation->date_out }}</td>
                <td>
                  <a class="hollow button" href="#">EDIT</a>
                  <a class="hollow button warning" href="#">DELETE</a>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection