@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Promethee</div>
                <div class="card-body">
                    <h2>Leaving and Entering Flow</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Mata Kuliah</th>
                                @foreach ($alter as $a)
                                    <th>{{$a->nama_matakuliah}}</th>
                                @endforeach
                                <th>Leaving Flow</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alter as $a)
                                <tr>
                                    <th>{{$a->nama_matakuliah}}</th>
                                    @php
                                     $lf=0;   
                                     $i=0;
                                    @endphp
                                    @foreach ($pro6 as $p)
                                        @if ($a['id'] == $p['id_alternatif'])
                                            <td>{{round($p['nilai'],4)}}</td>
                                            @php
                                                $lf += floatval($p['nilai']);
                                                $i++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <td> {{round($lf/$i,4)}} </td>
                                </tr>
                            @endforeach
                                <tr>
                                    <th>Entering Flow</th>
                                    @foreach ($ef as $e)
                                    <td>{{round($e/$i,4)}}</td>
                                    @endforeach
                                </tr>
                        </tbody>
                    </table>
                    <br>
                    <h2>Net Flow</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Net Flow</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pro7 as $p7)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$p7->nama_matakuliah}}</td>
                                    <td>{{$p7->nilai}}</td>
                                </tr>
                                @php
                                    $no++
                                @endphp
                            @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection