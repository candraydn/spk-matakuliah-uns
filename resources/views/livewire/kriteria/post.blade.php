<div>
    <div class="my-4">
        <form class="form-inline" wire:submit.prevent="addKriteria">
            <input type="text" style="width:30%" class="form-control" wire:model="nama_kriteria"
                placeholder="Ketik kriteria baru" required>
            <button class="btn btn-success mx-2" type="submit">Kirim</button>
        </form>
    </div>
</div>