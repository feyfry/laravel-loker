{{-- Modal --}}
<div class="modal fade" id="downloadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    <i class="fas fa-file-arrow-down"></i> Download Laporan
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('panel.lamaran.download') }}" method="post" id="downloadForm">
                    @csrf

                    <!-- Pilihan Format -->
                    <div class="mb-3">
                        <label for="format" class="form-label">Format Laporan</label>
                        <select name="format" id="format" class="form-select @error('format') is-invalid @enderror">
                            <option value="" hidden>-- Pilih Format --</option>
                            <option value="pdf" {{ old('format') == 'pdf' ? 'selected' : '' }}>PDF</option>
                            <option value="excel" {{ old('format') == 'excel' ? 'selected' : '' }}>Excel</option>
                        </select>
                        @error('format')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Akhir -->
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Preview Format yang dipilih -->
                    <div class="mt-3">
                        <div id="pdfPreview" class="d-none">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-file-pdf"></i> Format PDF
                                </h6>
                                <p class="mb-0">Laporan akan diunduh dalam format PDF dengan tampilan yang terstruktur, termasuk:</p>
                                <ul class="mb-0">
                                    <li>Header laporan dengan periode</li>
                                    <li>Ringkasan statistik</li>
                                    <li>Tabel data detail</li>
                                    <li>Footer dengan informasi cetak</li>
                                </ul>
                            </div>
                        </div>
                        <div id="excelPreview" class="d-none">
                            <div class="alert alert-success">
                                <h6 class="alert-heading">
                                    <i class="fas fa-file-excel"></i> Format Excel
                                </h6>
                                <p class="mb-0">Laporan akan diunduh dalam format Excel (.xlsx) yang dapat diedit, dengan:</p>
                                <ul class="mb-0">
                                    <li>Header kolom yang jelas</li>
                                    <li>Data yang dapat difilter dan diurutkan</li>
                                    <li>Format yang mudah diolah</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" form="downloadForm" class="btn btn-secondary">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    // Preview format yang dipilih
    document.getElementById('format').addEventListener('change', function() {
        // Sembunyikan semua preview
        document.getElementById('pdfPreview').classList.add('d-none');
        document.getElementById('excelPreview').classList.add('d-none');

        // Tampilkan preview yang dipilih
        if (this.value === 'pdf') {
            document.getElementById('pdfPreview').classList.remove('d-none');
        } else if (this.value === 'excel') {
            document.getElementById('excelPreview').classList.remove('d-none');
        }
    });

    // Validasi tanggal
    document.getElementById('downloadForm').addEventListener('submit', function(e) {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const format = document.getElementById('format').value;

        if (!format) {
            e.preventDefault();
            alert('Silakan pilih format laporan');
            return;
        }

        if (!startDate || !endDate) {
            e.preventDefault();
            alert('Silakan isi kedua tanggal');
            return;
        }

        if (new Date(startDate) > new Date(endDate)) {
            e.preventDefault();
            alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir');
            return;
        }
    });

    // Set default dates untuk range 30 hari terakhir
    window.addEventListener('load', function() {
        const today = new Date();
        const thirtyDaysAgo = new Date(today);
        thirtyDaysAgo.setDate(today.getDate() - 30);

        document.getElementById('end_date').value = today.toISOString().split('T')[0];
        document.getElementById('start_date').value = thirtyDaysAgo.toISOString().split('T')[0];
    });
</script>
@endpush
