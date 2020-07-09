<div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Kriteria</th>
            <th scope="col">Options</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($kriterias as $kriteria)
            <tr>
                <th scope="row">{{$no}}</th>
                <td>{{$kriteria->nama_kriteria }}</td>
                <td>
                    <a href="{{route('kriteria.edit',$kriteria->id)}}" class="btn btn-primary">Ubah</a>
                    <a href="" wire:click.prevent="deleteKriteria({{$kriteria->id}})" onclick="return confirm('Yakin menghapus?') || event.stopImmediatePropagation()" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
              @php
                $no++   
              @endphp
            @endforeach
        </tbody>
      </table>
</div>