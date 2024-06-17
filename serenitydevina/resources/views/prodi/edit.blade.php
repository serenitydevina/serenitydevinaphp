@extends('layout.master')

@section('title','Form Data Diri')
@section('content')
<div class="container">
<h1>Edit Prodi </h1>
@if (session()->has('info'))
<div class="alert alert-success">
    {{session()->get('info')}}
</div>
@endif
<form action="{{ route('prodi.update',['prodi'=>$prodi->id])}}" method="POST">
@method('PATCH')
@csrf
<div class="form-group">
    <label for ="nama">Nama Prodi</label>
    <input type="text" name="nama" id="nama"class="form-control"
    value="{{ old('nama') ?? $prodi->nama}}">
    @error('nama')
    <div class="text-danger">{{$message}}
</div>
@enderror
</div>
<button type="submit" class="btn btn-primary mt-2">UBAH</button>
</form>
@endsection