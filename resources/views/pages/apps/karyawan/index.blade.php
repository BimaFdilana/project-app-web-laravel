<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Cuti Karyawan</title>
    <link rel="stylesheet" href="{{ asset('css/karyawan.css') }}">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📅 Sistem Cuti Karyawan</h1>
            <p>Dashboard untuk memantau pengajuan cuti karyawan</p>
        </div>

        <div class="controls">
            <div class="filter-group">
                <label for="monthFilter">Bulan</label>
                <select id="monthFilter" class="filter-input">
                    <option value="">Semua Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="yearFilter">Tahun</label>
                <select id="yearFilter" class="filter-input">
                    <option value="">Semua Tahun</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="departmentFilter">Bagian</label>
                <select id="departmentFilter" class="filter-input">
                    <option value="">Semua Bagian</option>
                    <option value="IT">IT</option>
                    <option value="HR">HR</option>
                    <option value="Finance">Finance</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Operations">Operations</option>
                </select>
            </div>

            <button class="reset-btn" onclick="resetFilters()">Reset Filter</button>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-number" id="totalLeaves">0</div>
                <div class="stat-label">Total Cuti</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="approvedLeaves">0</div>
                <div class="stat-label">Disetujui</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="pendingLeaves">0</div>
                <div class="stat-label">Menunggu</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="rejectedLeaves">0</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>

        <div class="content">
            <div class="leave-grid" id="leaveGrid">
                <!-- Data akan dimuat di sini -->
            </div>
        </div>
    </div>

    <script>
        // Data dummy untuk demonstrasi
        const leaveData = [{
                id: 1,
                employeeName: "Ahmad Ridwan",
                department: "IT",
                leaveDates: ["2024-07-15", "2024-07-16", "2024-07-17"],
                totalDays: 3,
                purpose: "Berlibur dengan keluarga",
                notes: "Sudah menyelesaikan semua tugas urgent",
                status: "approved"
            },
            {
                id: 2,
                employeeName: "Sari Dewi",
                department: "HR",
                leaveDates: ["2024-07-20"],
                totalDays: 1,
                purpose: "Keperluan medis",
                notes: "Kontrol kesehatan rutin",
                status: "pending"
            },
            {
                id: 3,
                employeeName: "Budi Santoso",
                department: "Finance",
                leaveDates: ["2024-08-01", "2024-08-02"],
                totalDays: 2,
                purpose: "Acara keluarga",
                notes: "Menghadiri pernikahan saudara",
                status: "approved"
            },
            {
                id: 4,
                employeeName: "Maya Putri",
                department: "Marketing",
                leaveDates: ["2024-07-25", "2024-07-26", "2024-07-27", "2024-07-28", "2024-07-29"],
                totalDays: 5,
                purpose: "Cuti tahunan",
                notes: "Liburan ke Bali bersama keluarga",
                status: "rejected"
            },
            {
                id: 5,
                employeeName: "Doni Pratama",
                department: "Operations",
                leaveDates: ["2024-09-10"],
                totalDays: 1,
                purpose: "Urusan pribadi",
                notes: "Mengurus dokumen penting",
                status: "approved"
            },
            {
                id: 6,
                employeeName: "Linda Sari",
                department: "IT",
                leaveDates: ["2024-08-15", "2024-08-16"],
                totalDays: 2,
                purpose: "Sakit",
                notes: "Demam dan flu",
                status: "approved"
            }
        ];

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

        function getStatusBadge(status) {
            const statusMap = {
                approved: {
                    text: 'Disetujui',
                    class: 'status-approved'
                },
                pending: {
                    text: 'Menunggu',
                    class: 'status-pending'
                },
                rejected: {
                    text: 'Ditolak',
                    class: 'status-rejected'
                }
            };

            const statusInfo = statusMap[status];
            return `<span class="status-badge ${statusInfo.class}">${statusInfo.text}</span>`;
        }

        function renderLeaveCards() {
            const grid = document.getElementById('leaveGrid');

            if (filteredData.length === 0) {
                grid.innerHTML = `
                    <div class="no-data">
                        <div class="no-data-icon">📭</div>
                        <p>Tidak ada data cuti yang sesuai dengan filter</p>
                    </div>
                `;
                return;
            }

            grid.innerHTML = filteredData.map(leave => `
                <div class="leave-card ${leave.status}">
                    <div class="employee-name">${leave.employeeName}</div>
                    <div class="department">${leave.department}</div>

                    <div class="leave-info">
                        <div class="info-row">
                            <span class="info-label">Tanggal Cuti:</span>
                            <div class="info-value">
                                <div class="dates-list">
                                    ${leave.leaveDates.map(date =>
                                        `<span class="date-tag">${formatDate(date)}</span>`
                                    ).join('')}
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Jumlah Hari:</span>
                            <span class="info-value">${leave.totalDays} hari</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Keperluan:</span>
                            <span class="info-value">${leave.purpose}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Keterangan:</span>
                            <span class="info-value">${leave.notes}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value">${getStatusBadge(leave.status)}</span>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function updateStats() {
            const total = filteredData.length;
            const approved = filteredData.filter(leave => leave.status === 'approved').length;
            const pending = filteredData.filter(leave => leave.status === 'pending').length;
            const rejected = filteredData.filter(leave => leave.status === 'rejected').length;

            // Animasi counter
            animateCounter('totalLeaves', total);
            animateCounter('approvedLeaves', approved);
            animateCounter('pendingLeaves', pending);
            animateCounter('rejectedLeaves', rejected);
        }

        function animateCounter(elementId, targetValue) {
            const element = document.getElementById(elementId);
            const currentValue = parseInt(element.textContent) || 0;
            const increment = targetValue > currentValue ? 1 : -1;
            const stepTime = Math.abs(Math.floor(200 / (targetValue - currentValue))) || 50;

            if (currentValue !== targetValue) {
                element.textContent = currentValue + increment;
                setTimeout(() => animateCounter(elementId, targetValue), stepTime);
            }
        }

        function applyFilters() {
            const monthFilter = document.getElementById('monthFilter').value;
            const yearFilter = document.getElementById('yearFilter').value;
            const departmentFilter = document.getElementById('departmentFilter').value;

            filteredData = leaveData.filter(leave => {
                // Filter berdasarkan bulan dan tahun dari tanggal cuti pertama
                const firstDate = new Date(leave.leaveDates[0]);
                const leaveMonth = firstDate.getMonth() + 1;
                const leaveYear = firstDate.getFullYear();

                const monthMatch = !monthFilter || leaveMonth.toString() === monthFilter;
                const yearMatch = !yearFilter || leaveYear.toString() === yearFilter;
                const departmentMatch = !departmentFilter || leave.department === departmentFilter;

                return monthMatch && yearMatch && departmentMatch;
            });

            renderLeaveCards();
            updateStats();
        }

        function resetFilters() {
            document.getElementById('monthFilter').value = '';
            document.getElementById('yearFilter').value = '';
            document.getElementById('departmentFilter').value = '';

            filteredData = [...leaveData];
            renderLeaveCards();
            updateStats();
        }

        // Event listeners
        document.getElementById('monthFilter').addEventListener('change', applyFilters);
        document.getElementById('yearFilter').addEventListener('change', applyFilters);
        document.getElementById('departmentFilter').addEventListener('change', applyFilters);

        // Inisialisasi halaman
        document.addEventListener('DOMContentLoaded', function() {
            renderLeaveCards();
            updateStats();
        });
    </script>
</body>

</html>
