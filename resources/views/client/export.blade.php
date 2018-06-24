<table class="stack">
  <thead>
    <tr>
      <th width="200">Name</th>
      <th width="200">Email</th>
    </tr>
  </thead>
  <tbody>

    @foreach( $clients as $client )
    <tr>
      <td>{{ $client->title }}. {{ $client->name }} {{ $client->last_name }}</td>
      <td>{{ $client->email }}</td>
    </tr>
    @endforeach

  </tbody>
</table>