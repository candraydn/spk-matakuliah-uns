@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kriteria</div>

                <div class="card-body">
                    <div class="my-4">
                        <form class="form-inline" method="post" action="{{route('kriteria.update',$kriteria->id)}}">
                            @method('patch')
                            @csrf
                            <input type="text" style="width:30%" class="form-control" name="nama_kriteria" value="{{$kriteria->nama_kriteria}}"
                                placeholder="Edit kriteria" required>
                            <button class="btn btn-success mx-2" type="submit">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
