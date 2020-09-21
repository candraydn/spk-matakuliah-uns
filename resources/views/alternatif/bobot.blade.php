@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bobot Alternatif</div>
                <div class="card-body">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="false" aria-controls="collapseOne">
                                        Mata Kuliah Semester 1
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form action="{{ route('bobot.alternatif.post') }}" method="POST">
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
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        Mata Kuliah Semester 2
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    semester 3
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Mata Kuliah Semester 3
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                    semester 3
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Mata Kuliah Semester 4
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                data-parent="#accordion">
                                <div class="card-body">
                                    semester 4
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
