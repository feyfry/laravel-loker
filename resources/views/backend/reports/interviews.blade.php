<!-- resources/views/reports/interviews.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Jadwal Interview</title>
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

        /* Analysis Section */
        .analysis-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }

        .analysis-grid {
            display: table;
            width: 100%;
            margin-top: 15px;
        }

        .analysis-row {
            display: table-row;
        }

        .analysis-cell {
            display: table-cell;
            width: 50%;
            padding: 15px;
            vertical-align: top;
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .analysis-label {
            font-weight: bold;
            margin-bottom: 8px;
            color: #2c3e50;
            font-size: 13px;
        }

        .analysis-value {
            font-size: 14px;
            color: #666;
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

        /* Badge Styles */
        .status-badge, .method-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            min-width: 80px;
        }

        .status-scheduled { background: #cce5ff; color: #004085; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }

        .method-online { background: #e3f2fd; color: #0d47a1; }
        .method-offline { background: #fff3e0; color: #e65100; }

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
        }

        /* Page number styles */
        .page-number {
            text-align: center;
        }

        /* Additional Utilities */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <!-- Company Header -->
        <div class="company-header">
            <img class="company-logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Company Logo">
            <h1 class="report-title">Laporan Jadwal Interview</h1>
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
                        <div class="stat-label">Total Interview</div>
                        <div class="stat-value">{{ $total_interviews }}</div>
                    </div>
                    <div class="summary-cell">
                        <div class="stat-label">Dijadwalkan</div>
                        <div class="stat-value" style="color: #3498db;">{{ $scheduled }}</div>
                    </div>
                    <div class="summary-cell">
                        <div class="stat-label">Selesai</div>
                        <div class="stat-value" style="color: #27ae60;">{{ $completed }}</div>
                    </div>
                    <div class="summary-cell">
                        <div class="stat-label">Dibatalkan</div>
                        <div class="stat-value" style="color: #e74c3c;">{{ $cancelled }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analysis Section -->
        <div class="analysis-section">
            <h3 class="summary-title">Analisis Interview</h3>
            <div class="analysis-grid">
                <div class="analysis-row">
                    <div class="analysis-cell">
                        <div class="analysis-label">Metode Interview</div>
                        <div class="analysis-value">
                            <p>Online: {{ $interviews->where('interview_method', 'online')->count() }} Kandidat</p>
                            <p>Offline: {{ $interviews->where('interview_method', 'offline')->count() }} Kandidat</p>
                        </div>
                    </div>
                    <div class="analysis-cell">
                        <div class="analysis-label">Tingkat Kehadiran</div>
                        <div class="analysis-value">
                            @php
                                $attendanceRate = $completed > 0 ? ($completed / $total_interviews * 100) : 0;
                            @endphp
                            <p class="font-bold" style="color: #27ae60; font-size: 18px;">
                                {{ number_format($attendanceRate, 1) }}%
                            </p>
                            <p style="font-size: 12px;">Dari total {{ $total_interviews }} jadwal interview</p>
                        </div>
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
                        <th width="20%">Nama Pelamar</th>
                        <th width="20%">Posisi</th>
                        <th width="15%">Tanggal Interview</th>
                        <th width="10%">Metode</th>
                        <th width="15%">Interviewer</th>
                        <th width="15%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($interviews as $index => $interview)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $interview->application->applicant->profile->full_name }}</td>
                        <td>{{ $interview->application->jobdesc->title }}</td>
                        <td>{{ Carbon\Carbon::parse($interview->interview_date)->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="method-badge method-{{ $interview->interview_method }}">
                                {{ ucfirst($interview->interview_method) }}
                            </span>
                        </td>
                        <td>{{ $interview->interviewer_name }}</td>
                        <td>
                            <span class="status-badge status-{{ $interview->status }}">
                                {{ ucfirst($interview->status) }}
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
