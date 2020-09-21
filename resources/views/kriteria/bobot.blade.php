@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bobot Kriteria</div>

                <div class="card-body">
                    @foreach($kriteria as $k)
                        @php
                            $data[] = $k['nama_kriteria'];
                        @endphp
                    @endforeach
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">Pilih yang lebih penting</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <form class="form-inline" method="post" action="{{ route('bobot.kriteria.post') }}">
                            @csrf
                        <tbody>
                            @php
                                $urut = 0;
                            @endphp
                            @for ($x=0; $x <= ($n - 2); $x++)
                                @for ($y=($x+1); $y <= ($n - 1) ; $y++)
                                @php
                                        $urut++
                                    @endphp
                                    <tr>
                                        <td><input class="form-check-input" type="radio" name="{{$urut}}" value="1">{{ $data[$x] }} </td>
                                        <td><input class="form-check-input" type="radio" name="{{$urut}}" value="2">{{ $data[$y] }} </td>
                                        <td>
                                            <select class="form-control" name="bobot{{$urut}}">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                @endfor
                            @endfor
                        </tbody>
                    </table>
                    <center><input type="submit" class="btn btn-success" value="Submit"></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
