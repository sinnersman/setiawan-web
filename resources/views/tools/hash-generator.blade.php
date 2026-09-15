@extends('layouts.app')
@section('content')
<div class="container py-10" style="max-width:720px">
  <h1>Hash Generator</h1>
  <p class="text-muted">MD5 / SHA-1 / SHA-256 / SHA-512 / bcrypt — murni PHP, tanpa shell.</p>
  <form method="POST" action="{{ url('/tools/hash-generator') }}">
    @csrf
    <div class="mb-3"><textarea name="text" class="form-control" rows="3" required>{{ $input ?? '' }}</textarea></div>
    <div class="mb-3"><select name="algo" class="form-control">
      @foreach(['sha256'=>'SHA-256','md5'=>'MD5','sha1'=>'SHA-1','sha512'=>'SHA-512','bcrypt'=>'bcrypt'] as $v=>$l)
        <option value="{{ $v }}" {{ ($algo ?? 'sha256')===$v?'selected':'' }}>{{ $l }}</option>
      @endforeach
    </select></div>
    <button class="btn btn-primary">Hash</button>
  </form>
  @if(!empty($result))<div class="mt-4">@foreach($result as $a=>$h)<p><strong>{{ $a }}</strong><br><code>{{ $h }}</code></p>@endforeach</div>@endif
</div>
@endsection
