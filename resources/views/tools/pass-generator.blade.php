@extends('layouts.app')
@section('content')
<div class="container py-10" style="max-width:720px">
  <h1>Password Generator</h1>
  <p class="text-muted">Berbasis <code>random_bytes()</code> + estimasi entropi.</p>
  <form method="POST" action="{{ url('/tools/pass-generator') }}">
    @csrf
    <div class="mb-3"><label>Panjang (4–128)</label><input type="number" name="length" class="form-control" value="{{ $length ?? 16 }}" min="4" max="128"></div>
    <div class="mb-3">
      <label><input type="checkbox" name="lower" value="1" checked> Huruf kecil</label><br>
      <label><input type="checkbox" name="upper" value="1" checked> Huruf besar</label><br>
      <label><input type="checkbox" name="digits" value="1" checked> Angka</label><br>
      <label><input type="checkbox" name="symbols" value="1"> Simbol</label>
    </div>
    <button class="btn btn-primary">Generate</button>
  </form>
  @if(!empty($result))<div class="mt-4"><p><code style="font-size:1.2em">{{ $result['password'] }}</code></p>
  <p>Entropi: <strong>{{ $result['entropy'] }} bit</strong> — Kekuatan: <strong>{{ $result['strength'] }}</strong> (pool {{ $result['pool_size'] }})</p></div>@endif
</div>
@endsection
