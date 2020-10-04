@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bobot Alternatif</div>
                <div class="card-body">
                    <label><a href="{{ route('bobot.alternatif') }}">Pilih Semester</a> > Input Bobot Mata Kuliah</label><br><br>
                    <form action="{{ route('bobot.alternatif.post') }}" method="POST">
                        <input type="hidden" name="semester" value="{{ $semester }}">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Mata Kuliah</th>
                                    @foreach ($krit as $k)
                                    <th>{{$k['nama_kriteria']}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @csrf
                                @foreach ($alter as $a)
                                <tr>
                                    <td>{{$a['nama_matakuliah']}}</td>
                                    @foreach ($krit as $k)
                                    <td><select class="form-control"
                                            name="nilai{{ $k['id'] }}{{ $a['id'] }}">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select></td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <center><input class="btn btn-success" value="Submit" type="submit"></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
