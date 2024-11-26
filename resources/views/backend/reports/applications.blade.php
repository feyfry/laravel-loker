<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Lamaran Kerja</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Reset dan Base Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #fff;
            padding-bottom: 150px;
            font-size: 12px;
            counter-reset: pageTotal;
        }

        /* Increment counter untuk setiap halaman */
        .pagenum:before {
            counter-increment: page;
        }

        /* Content Wrapper */
        .content-wrapper {
            margin: 0 20px;
        }

        /* Header Styles */
        .company-header {
            text-align: center;
            padding: 20px 0 30px;
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 30px;
        }

        .company-logo {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
        }

        .report-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .report-subtitle {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .report-period {
            display: inline-block;
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 13px;
        }

        /* Summary Styles */
        .summary-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }

        .summary-title {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .summary-grid {
            display: table;
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px;
        }

        .summary-row {
            display: table-row;
        }

        .summary-cell {
            display: table-cell;
            width: 25%;
            background: white;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .stat-label {
            font-size: 11px;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Table Styles */
        .table-container {
            margin-bottom: 40px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .data-table th {
            background: #2c3e50;
            color: white;
            padding: 12px;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        .data-table tr:nth-child(even) {
            background: #f8f9fa;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        /* Status Badge Styles */
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            min-width: 80px;
        }

        .status-pending {
            background: #ffeeba;
            color: #856404;
        }

        .status-accepted {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        /* Signature Section */
        .signature-section {
            margin: 40px 20px;
            page-break-inside: avoid;
        }

        .signature-grid {
            display: table;
            width: 100%;
        }

        .signature-box {
            display: table-cell;
            width: 50%;
            padding: 0 20px;
            text-align: center;
            vertical-align: top;
        }

        .signature-line {
            width: 200px;
            margin: 40px auto 10px;
            border-top: 1px solid #333;
        }

        .signature-name {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .signature-title {
            font-size: 12px;
            color: #666;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px 20px;
            background: white;
            border-top: 1px solid #e9ecef;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        /* Page number styles */
        .page-number {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <!-- Company Header -->
        <div class="company-header">
            <img class="company-logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Company Logo">
            <h1 class="report-title">Laporan Data Lamaran Kerja</h1>
            <p class="report-subtitle">Sistem Informasi Penerimaan Karyawan</p>
            <div class="report-period">
                Periode: {{ $start_date }} - {{ $end_date }}
            </div>
        </div>

        <!-- Summary Section -->
        <div class="summary-section">
            <h3 class="summary-title">Ringkasan Statistik</h3>
            <div class="summary-grid">
                <div class="summary-row">
                    <div class="summary-cell">
                        <div class="stat-label">Total Lamaran</div>
                        <div class="stat-value">{{ $total_lamaran }}</div>
                    </div>
                    <div class="summary-cell">
                        <div class="stat-label">Pending</div>
                        <div class="stat-value" style="color: #f39c12;">{{ $pending }}</div>
                    </div>
                    <div class="summary-cell">
                        <div class="stat-label">Diterima</div>
                        <div class="stat-value" style="color: #27ae60;">{{ $accepted }}</div>
                    </div>
                    <div class="summary-cell">
                        <div class="stat-label">Ditolak</div>
                        <div class="stat-value" style="color: #e74c3c;">{{ $rejected }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Pelamar</th>
                        <th width="20%">Posisi</th>
                        <th width="20%">Perusahaan</th>
                        <th width="15%">Tanggal</th>
                        <th width="15%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lamarans as $index => $lamaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $lamaran->applicant->profile->full_name }}</td>
                        <td>{{ $lamaran->jobdesc->title }}</td>
                        <td>{{ $lamaran->jobdesc->company_name }}</td>
                        <td>{{ Carbon\Carbon::parse($lamaran->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ $lamaran->status }}">
                                {{ ucfirst($lamaran->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-grid">
                <div class="signature-box">
                    <p>Dibuat oleh,</p>
                    <br>
                    <br>
                    <div class="signature-line"></div>
                    <p class="signature-name">{{ Auth::user()->username }}</p>
                    <p class="signature-title">Admin HR</p>
                </div>
                <div class="signature-box">
                    <p>Mengetahui,</p>
                    <br>
                    <br>
                    <div class="signature-line"></div>
                    <p class="signature-name">____________________</p>
                    <p class="signature-title">Kepala HRD</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-content">
            <span>Dicetak pada: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s') }}</span>
        </div>
        <div class="page-number">
            <script type="text/php">
                if (isset($pdf)) {
                    $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
                    $size = 8;
                    $font = $fontMetrics->getFont("Arial");
                    $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                    $x = ($pdf->get_width() - $width);
                    $y = $pdf->get_height() - 25;
                    $pdf->page_text($x, $y, $text, $font, $size);
                }
            </script>
        </div>
    </div>
</body>
</html>
