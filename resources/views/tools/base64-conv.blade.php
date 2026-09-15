@extends('layouts.app')
@section('content')
<div class="container py-10" style="max-width:720px">
  <h1>Base64 Converter</h1>
  <p class="text-muted">Encode / decode / URL-safe / hex.</p>
  <form method="POST" action="{{ url('/tools/base64-conv') }}">
    @csrf
    <div class="mb-3"><textarea name="text" class="form-control" rows="3" required>{{ $input ?? '' }}</textarea></div>
    <div class="mb-3"><select name="mode" class="form-control">
      @foreach(['encode'=>'Base64 Encode','decode'=>'Base64 Decode','url_encode'=>'Base64 URL-safe Encode','url_decode'=>'Base64 URL-safe Decode','hex_encode'=>'Hex Encode','hex_decode'=>'Hex Decode'] as $v=>$l)
        <option value="{{ $v }}" {{ ($mode ?? 'encode')===$v?'selected':'' }}>{{ $l }}</option>
      @endforeach
    </select></div>
    <button class="btn btn-primary">Konversi</button>
  </form>
  @if(!empty($error))<div class="alert alert-danger mt-3">{{ $error }}</div>@endif
  @if(!empty($result))<div class="mt-4"><p><code>{{ $result }}</code></p></div>@endif
</div>
@endsection
