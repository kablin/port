@if ($attrs)
  @foreach ($attrs as $key => $attr)
  {{$key}} : {{$attr}}
  <br>

  @endforeach
@endif
