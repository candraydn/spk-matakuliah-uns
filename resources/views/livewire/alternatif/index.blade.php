<div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Mata Kuliah</th>
            <th scope="col">Semester</th>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Options</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($alternatifs as $alternatif)
            <tr>
                <th scope="row">{{$no}}</th>
                <td>{{$alternatif->nama_matakuliah }}</td>
                <td>{{$alternatif->semester_matakuliah }}</td>
                <td>{{$alternatif->dosen_matakuliah }}</td>
                <td>
                    <a href="{{route('alternatif.edit',$alternatif->id)}}" class="btn btn-primary">Ubah</a>
                    <a href="" wire:click.prevent="deleteAlter({{$alternatif->id}})" onclick="return confirm('Yakin menghapus?') || event.stopImmediatePropagation()" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
              @php
                $no++   
              @endphp
            @endforeach
        </tbody>
      </table>
</div>