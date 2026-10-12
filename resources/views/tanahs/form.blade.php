@csrf

<div class="form-notice mb-4">
    <i class="fa fa-circle-info"></i>
    <span>Kolom bertanda <span class="text-danger fw-bold">*</span> wajib diisi.</span>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <label for="jenis_id" class="form-label">Jenis <span class="text-danger">*</span></label>
        <select name="jenis_id" id="jenis_id" class="form-select @error('jenis_id') is-invalid @enderror" required>
            <option value="">Pilih Jenis</option>
            @foreach($jenis as $j)
                <option value="{{ $j->id }}" {{ (old('jenis_id', $tanah->jenis_id ?? '') == $j->id) ? 'selected' : '' }}>
                    {{ $j->nama_jenis }}
                </option>
            @endforeach
        </select>
        @error('jenis_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nama" class="form-label">Nama Tanah <span class="text-danger">*</span></label>
        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
            placeholder="Contoh: Tanah Masjid Al-Ikhlas"
            value="{{ old('nama', $tanah->nama ?? '') }}" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="luas" class="form-label">Luas (m²) <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <input type="number" name="luas" id="luas" min="0" step="any"
                class="form-control @error('luas') is-invalid @enderror" placeholder="0"
                value="{{ old('luas', $tanah->luas ?? '') }}" required>
            <span class="input-group-text">m²</span>
            @error('luas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="wakif" class="form-label">Wakif</label>
        <input type="text" name="wakif" id="wakif" class="form-control @error('wakif') is-invalid @enderror"
            placeholder="Nama wakif (opsional)"
            value="{{ old('wakif', $tanah->wakif ?? '') }}">
        @error('wakif')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="alamat" class="form-label">Alamat (RT/RW/Dusun) <span class="text-danger">*</span></label>
        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
            placeholder="Contoh: RT 02/RW 05, Dusun Krajan"
            value="{{ old('alamat', $tanah->alamat ?? '') }}" required>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="desa_id" class="form-label">Desa <span class="text-danger">*</span></label>
        <select name="desa_id" id="desa_id" class="form-select @error('desa_id') is-invalid @enderror" required>
            <option value="">Pilih Desa</option>
            @foreach($desas as $desa)
                <option value="{{ $desa->id }}" {{ (old('desa_id', $tanah->desa_id ?? '') == $desa->id) ? 'selected' : '' }}>
                    {{ $desa->nama_desa }}
                </option>
            @endforeach
        </select>
        @error('desa_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nadzir_id" class="form-label">Nadzir <span class="text-danger">*</span></label>
        <select name="nadzir_id" id="nadzir_id" class="form-select @error('nadzir_id') is-invalid @enderror" required>
            <option value="">Pilih Nadzir</option>
            @foreach($nadzirs as $nadzir)
                <option value="{{ $nadzir->id }}" {{ (old('nadzir_id', $tanah->nadzir_id ?? '') == $nadzir->id) ? 'selected' : '' }}>
                    {{ $nadzir->nama_nadzir }}
                </option>
            @endforeach
        </select>
        @error('nadzir_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<style>
    .form-notice {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        background: #f7f6f0;
        color: var(--claude-text-light, #706b5b);
        border: 1px solid var(--claude-border, #e6e4dc);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.88rem;
    }

    .form-notice i {
        font-size: 1rem;
        color: var(--claude-brand, #0f766e);
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--claude-text, #3d3929);
        margin-bottom: 0.35rem;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid var(--claude-border, #e6e4dc);
        background-color: var(--claude-surface, #ffffff);
        color: var(--claude-text, #3d3929);
        padding: 0.55rem 0.85rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--claude-brand, #0f766e);
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        background-color: #ffffff;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc2626;
    }

    .input-group-text {
        border-radius: 0 8px 8px 0;
        background: #f7f6f0;
        border: 1px solid var(--claude-border, #e6e4dc);
        border-left: none;
        color: var(--claude-text-light, #706b5b);
        font-size: 0.85rem;
    }
</style>