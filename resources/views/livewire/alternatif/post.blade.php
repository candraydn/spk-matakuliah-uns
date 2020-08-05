<div>
    @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    <div class="my-4">
        <form class="form-inline" wire:submit.prevent="addAlternatif">
            <input type="text" style="width:30%" class="form-control mx-2" wire:model="matkul"
                placeholder="Nama Mata Kuliah baru" required>
            <select class="custom-select mx-2" wire:model="semester" required>
                <option value="" selected>Pilih Semester</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
                <option value="7">Semester 7</option>
                <option value="8">Semester 8</option>
            </select>
            <input type="text" style="width:30%" class="form-control mx-2" wire:model="dosen"
                placeholder="Nama Dosen Pengampu" required>
            <button class="btn btn-success mx-2" type="submit">Kirim</button>
        </form>
    </div>
</div>