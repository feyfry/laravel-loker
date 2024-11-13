<x-mail::message>
# Status Lamaran Anda - {{ $lamaran->status }}

Kepada {{ $lamaran->applicant->profile->full_name }},

Terima kasih telah melamar posisi **{{ $lamaran->jobdesc->title }}** bidang **{{ $lamaran->jobdesc->position }}** di **{{ $lamaran->jobdesc->company_name }}**. Kami ingin memberikan informasi terkait status lamaran Anda saat ini.

@if ($lamaran->status === 'reviewed')
Kami ingin menginformasikan bahwa lamaran Anda saat ini sedang dalam proses peninjauan oleh tim rekrutmen kami. Kami akan segera menghubungi Anda jika ada perkembangan lebih lanjut terkait proses ini.
@elseif ($lamaran->status === 'rejected')
Setelah melakukan peninjauan yang cermat, kami ingin menyampaikan bahwa, untuk saat ini, kami belum dapat melanjutkan proses perekrutan Anda untuk posisi tersebut. Kami sangat menghargai ketertarikan Anda dan mendorong Anda untuk melamar lagi di masa mendatang jika ada posisi yang sesuai.
@elseif ($lamaran->status === 'accepted')
Selamat! Kami sangat senang menginformasikan bahwa Anda telah berhasil melewati proses seleksi untuk posisi ini. Kami percaya bahwa keterampilan dan pengalaman Anda akan menjadi tambahan yang berharga untuk tim kami.

Cek secara berkala untuk informasi lebih lanjut tentang jadwal dan lokasi wawancara selanjutnya pada halaman <a href="{{ route('panel.jadwal-interview.pelamar.index') }}">Jadwal Interview</a>.
Pastikan Anda datang ke perusahaan kami tepat waktu untuk wawancara.

Atau silakan klik tombol di bawah untuk melihat jadwal interview Anda dan mendapatkan informasi lebih lanjut tentang persiapan wawancara.
@endif

@if ($lamaran->status === 'accepted')
<x-mail::button :url="route('panel.jadwal-interview.pelamar.index')">
Lihat Jadwal Interview
</x-mail::button>
@else
<x-mail::button :url="route('panel.dashboard')">
Lihat Status Lamaran
</x-mail::button>
@endif

Terima kasih atas waktu dan usaha yang telah Anda berikan. Kami berharap yang terbaik untuk Anda.

Salam hangat,<br>
Vespersec Team
</x-mail::message>
