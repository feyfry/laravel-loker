<x-mail::message>
# Status Lamaran Anda - {{ $lamaran->status }}

Kepada {{ $lamaran->applicant->profile->full_name }},

Terima kasih telah melamar posisi **{{ $lamaran->jobdesc->title }}** bidang **{{ $lamaran->jobdesc->position }}** di **{{ $lamaran->jobdesc->company_name }}**. Kami sangat menghargai waktu dan minat Anda untuk menjadi bagian dari tim kami. Saat ini, status lamaran Anda masih {{ $lamaran->status }}.

Kami berusaha untuk memberikan respon secepat mungkin, namun proses ini mungkin membutuhkan waktu untuk memastikan bahwa setiap kandidat dinilai dengan cermat.

<x-mail::button :url="route('panel.dashboard')">
Lihat Status Lamaran
</x-mail::button>

Terima kasih atas kesabaran Anda, dan kami akan menghubungi Anda kembali segera setelah ada perkembangan terbaru.

Salam hangat,<br>
Vespersec Team
</x-mail::message>

