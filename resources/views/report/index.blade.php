@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Laporan</div>
                <div class="card-body">
                    <form id="semester" method="post" action="">
                        @csrf
                        <div class="form-group">
                            <label for="pilihsemester">Pilih Semester</label>
                            <select name="pilihsemester" class="form-control" id="pilihsemester">
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>
                            </select>
                        </div>
                        <input class="btn btn-success" type="submit" value="Pilih" name="submit">
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
