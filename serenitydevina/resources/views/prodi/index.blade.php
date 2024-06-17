@extends('layout.master')

@section('title','Data Prodi')
@section('content')
<div class="container">
    <h1>Data List Prodi</h1>
    <a href="{{route('prodi.create')}}" class="btn btn-success">Tambah </a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Logo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listprodi as $item )
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nama}}</td>
                <td>
                    <img src="{{ asset('storage/'.$item->foto)}}" width="100px">
                </td>
                <td>
                    <!-- <a href="{{url('prodi/',$item->id)}}" class="btn btn-warning">Detail</a> -->
                    <!-- <a href="{{ url('prodi/',$item->id.'/edit')}}"class="btn btn-info">EDIT</a> -->
                    <form action="{{route('prodi.destroy',['prodi'=>$item->id])}}" method="POST">
                    <a href="{{ url('prodi/'.$item->id)}}" class="btn btn-warning">Detail</a>
                    <a href="{{ url('prodi/'.$item->id.'/edit')}}"class="btn btn-info">EDIT</a>
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection