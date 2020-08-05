@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Alternatif</div>

                <div class="card-body">
                    <div class="my-4">
                        <form class="form-inline" method="post" action="{{route('alternatif.update',$alterData->id)}}">
                            @method('patch')
                            @csrf
                            <input type="text" style="width:30%" class="form-control mx-2" name="matkul"
                                placeholder="Nama Mata Kuliah baru" value="{{ $alterData->nama_matakuliah }}" required>
                            <select class="custom-select mx-2" name="semester" required>
                                <option value="">Pilih Semester</option>
                                <option value="1" {{ ($alterData->semester_matakuliah == 1) ? 'selected' : ''}}>Semester 1</option>
                                <option value="2" {{ ($alterData->semester_matakuliah == 2) ? 'selected' : ''}}>Semester 2</option>
                                <option value="3" {{ ($alterData->semester_matakuliah == 3) ? 'selected' : ''}}>Semester 3</option>
                                <option value="4" {{ ($alterData->semester_matakuliah == 4) ? 'selected' : ''}}>Semester 4</option>
                                <option value="5" {{ ($alterData->semester_matakuliah == 5) ? 'selected' : ''}}>Semester 5</option>
                                <option value="6" {{ ($alterData->semester_matakuliah == 6) ? 'selected' : ''}}>Semester 6</option>
                                <option value="7" {{ ($alterData->semester_matakuliah == 7) ? 'selected' : ''}}>Semester 7</option>
                                <option value="8" {{ ($alterData->semester_matakuliah == 8) ? 'selected' : ''}}>Semester 8</option>
                            </select>
                            <input type="text" style="width:30%" class="form-control mx-2" name="dosen"
                                placeholder="Nama Dosen Pengampu" value="{{ $alterData->dosen_matakuliah }}" required>
                            <button class="btn btn-success mx-2" type="submit">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
