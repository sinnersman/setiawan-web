@extends('layouts.app')
@section('content')
<div class="container py-10" style="max-width:720px">
  <h1>JSON Viewer</h1>
  <p class="text-muted">Validasi + pretty-print JSON.</p>
  <form method="POST" action="{{ url('/tools/json-viewer') }}">
    @csrf
    <div class="mb-3"><textarea name="json" class="form-control font-monospace" rows="6" required>{{ $input ?? '' }}</textarea></div>
    <button class="btn btn-primary">Validate &amp; Format</button>
  </form>
  @if(!empty($error))<div class="alert alert-danger mt-3">{{ $error }}</div>@endif
  @if(!empty($result))<div class="mt-4"><div class="alert alert-success">JSON valid ✓</div><pre><code>{{ $result['pretty'] }}</code></pre></div>@endif
</div>
@endsection
