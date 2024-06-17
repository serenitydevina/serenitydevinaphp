@extends('layout.master')
@section('title','Halaman Prodi')

@section('content')
<h2>Mahasiswa</h2>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>NPM</th><th>Nama Mahasiswa</th><th>Nama Prodi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allmahasiswa as $item )
        <tr>
            <td>{{$item->npm}}</td><td>{{$item->nama_mahasiswa}}</td><td>{{$item->prodi->nama}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection


