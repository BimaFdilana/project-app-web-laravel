<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Cuti Karyawan</title>
    <link rel="stylesheet" href="{{ asset('css/karyawan.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📅 Jadwal Cuti Karyawan</h1>
            <p>Dashboard publik untuk memantau jadwal cuti</p>
        </div>
        <div class="controls">
            <div class="filter-group">
                <label for="nameFilter">Nama</label>
                <input type="text" id="nameFilter" class="filter-input" placeholder="Cari berdasarkan nama...">
            </div>
            <br>
            <div class="filter-group">
                <label for="monthFilter">Bulan</label>
                <select id="monthFilter" class="filter-input">
                    <option value="">Semua Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="filter-group">
                <label for="yearFilter">Tahun</label>
                <select id="yearFilter" class="filter-input">
                    <option value="">Semua Tahun</option>
                    @for ($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button class="reset-btn" onclick="resetFilters()">Reset Filter</button>
        </div>

        <div class="content">
            <div class="leave-grid" id="leaveGrid">
            </div>
        </div>
    </div>

    <script>
        const leaveData = @json($cutiDataForJs);

        let filteredData = [...leaveData];

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const options = {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            return date.toLocaleDateString('id-ID', options);
        }

        function renderLeaveCards() {
            const grid = document.getElementById('leaveGrid');
            grid.innerHTML = '';

            if (filteredData.length === 0) {
                grid.innerHTML =
                    `<div class="no-data"><div class="no-data-icon">📭</div><p>Tidak ada data cuti yang sesuai dengan filter</p></div>`;
                return;
            }

            grid.innerHTML = filteredData.map(leave => {
                // Logika untuk progress bar
                const percentage = leave.progressPercentage;
                let colorClass = 'bg-secondary'; // Abu-abu (default)
                let tooltipText = 'Belum Dimulai';

                if (percentage > 0) {
                    tooltipText = `${percentage}% Selesai`;
                    colorClass = 'bg-danger'; // Merah
                    if (percentage >= 34 && percentage < 67) {
                        colorClass = 'bg-warning'; // Kuning
                    } else if (percentage >= 67) {
                        colorClass = 'bg-success'; // Hijau
                    }
                }

                // Return HTML untuk setiap kartu cuti
                return `
            <div class="leave-card">
                <div class="employee-name">${leave.employeeName}</div>
                <div class="department">${leave.department}</div>
                <div class="leave-info">

                    <div class="info-row">
                        <span class="info-label">Tanggal Cuti:</span>
                        <div class="info-value">
                            ${leave.startDate} - ${leave.endDate}
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Progres:</span>
                        <div class="info-value" style="width: 50%;">
                             <div class="progress" title="${tooltipText}">
                                <div class="progress-bar ${colorClass}" style="width: ${percentage}%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Jumlah Hari:</span>
                        <span class="info-value">${leave.totalDays} hari</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Keperluan:</span>
                        <span class="info-value">${leave.purpose || '-'}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Keterangan:</span>
                        <span class="info-value">${leave.notes || '-'}</span>
                    </div>
                </div>
            </div>
        `;
            }).join('');
        }

        function applyFilters() {
            // Mengambil nilai dari setiap filter
            const nameFilter = document.getElementById('nameFilter').value.toLowerCase();
            const monthFilter = document.getElementById('monthFilter').value;
            const yearFilter = document.getElementById('yearFilter').value;

            filteredData = leaveData.filter(leave => {
                // Logika filter
                const firstDate = new Date(leave.leaveDates[0]);
                const leaveMonth = firstDate.getMonth() + 1;
                const leaveYear = firstDate.getFullYear();

                const nameMatch = !nameFilter || leave.employeeName.toLowerCase().includes(nameFilter);
                const monthMatch = !monthFilter || leaveMonth.toString() === monthFilter;
                const yearMatch = !yearFilter || leaveYear.toString() === yearFilter;

                return nameMatch && monthMatch && yearMatch;
            });
            renderLeaveCards();
        }

        function resetFilters() {
            // Mereset nilai semua filter
            document.getElementById('nameFilter').value = '';
            document.getElementById('monthFilter').value = '';
            document.getElementById('yearFilter').value = '';
            filteredData = [...leaveData];
            renderLeaveCards();
        }

        // Menambahkan event listener untuk setiap filter
        document.getElementById('nameFilter').addEventListener('input', applyFilters); // 'input' agar lebih responsif
        document.getElementById('monthFilter').addEventListener('change', applyFilters);
        document.getElementById('yearFilter').addEventListener('change', applyFilters);

        document.addEventListener('DOMContentLoaded', function() {
            renderLeaveCards();
        });
    </script>
</body>

</html>
