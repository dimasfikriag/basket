@extends('layouts.app')

@section('content')
    <h1 class="page-title">Log Aktivitas</h1>
    <p class="text-muted">Riwayat update yang dilakukan oleh admin, pelatih, atau pemain.</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="log-controls" style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
        <form method="POST" action="{{ route('admin.activity-logs.destroy-old') }}" style="display: flex; gap: 8px; align-items: center;">
            @csrf
            <label for="days" style="font-weight: 600;">Hapus log lebih lama dari:</label>
            <select name="days" id="days" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px;">
                <option value="7">7 hari</option>
                <option value="14">14 hari</option>
                <option value="30" selected>30 hari</option>
                <option value="60">60 hari</option>
                <option value="90">90 hari</option>
            </select>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus log lama?')">Hapus Log Lama</button>
        </form>
    </div>

    <div class="activity-log-card">
        <div class="activity-log-header">
            <span>Catatan Update</span>
            <span class="activity-log-count">{{ $logs->total() }} entri</span>
        </div>

        <div class="table-responsive">
            <table class="activity-log-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Edit</th>
                        <th>Update</th>
                        <th style="width: 80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $log->user_name ?? 'Tidak diketahui' }}</td>
                            <td>{{ $log->description }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.activity-logs.destroy', $log->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus log ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-small btn-danger" style="padding: 6px 10px; font-size: 0.85rem;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Belum ada log aktivitas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="activity-log-footer">
            {{ $logs->links() }}
        </div>
    </div>

    <style>
        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .btn-small {
            padding: 6px 10px;
            font-size: 0.85rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .activity-log-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
            padding: 24px;
            margin-top: 20px;
        }

        .activity-log-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            gap: 12px;
        }

        .activity-log-header span {
            font-weight: 600;
            color: #111827;
        }

        .activity-log-count {
            font-size: 0.95rem;
            color: #6b7280;
        }

        .activity-log-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 640px;
        }

        .activity-log-table thead {
            background: #1f2937;
        }

        .activity-log-table th,
        .activity-log-table td {
            padding: 14px 16px;
            text-align: left;
            vertical-align: top;
        }

        .activity-log-table th {
            color: #ffffff;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .activity-log-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s ease;
        }

        .activity-log-table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .activity-log-table tbody tr:hover {
            background: #f3f4f6;
        }

        .activity-log-table td {
            color: #374151;
            line-height: 1.6;
        }

        .activity-log-footer {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        @media (max-width: 768px) {
            .activity-log-table {
                min-width: 100%;
            }

            .log-controls {
                flex-direction: column;
            }
        }
    </style>
@endsection
