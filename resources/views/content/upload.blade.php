@extends('layout.app')

@section('content')
    <div class="row">
      <div class="medium-6 columns">
      <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image_upload">
        <small class="error">{{ $errors->first('image_upload') }}</small>
        <input type="submit" value="UPLOAD" class="button success hollow">
      </form>
    </div>
@endsection