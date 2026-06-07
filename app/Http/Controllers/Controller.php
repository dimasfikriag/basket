<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function logActivity($model, string $action, ?array $changes = null): void
    {
        $user = Auth::user();

        $modelLabel = $this->getModelLabel($model);
        $description = match ($action) {
            'update' => $this->buildUpdateDescription($model, $changes),
            default => ucfirst($action) . ' ' . class_basename($model) . ($modelLabel ? ' ' . $modelLabel : ''),
        };

        ActivityLog::create([
            'user_id' => $user?->id,
            'user_name' => $user?->name,
            'user_role' => $user?->role,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->getKey(),
            'action' => $action,
            'description' => $description,
            'changes' => $changes,
        ]);
    }

    private function buildUpdateDescription($model, ?array $changes): string
    {
        $modelLabel = $this->getModelLabel($model);
        $base = 'Mengubah ' . class_basename($model);
        if ($modelLabel) {
            $base .= ' ' . $modelLabel;
        }

        if (! $changes) {
            return $base;
        }

        $labels = [
            'user_id' => 'user',
            'nama_lengkap' => 'nama lengkap',
            'lisensi' => 'lisensi',
            'spesialisasi' => 'spesialisasi',
            'no_hp' => 'no HP',
            'alamat' => 'alamat',
            'tanggal_lahir' => 'tanggal lahir',
            'nomor_punggung' => 'nomor punggung',
            'posisi' => 'posisi',
            'tinggi_badan' => 'tinggi badan',
            'berat_badan' => 'berat badan',
            'status_kehadiran' => 'status kehadiran',
            'keterangan' => 'keterangan',
            'stamina' => 'stamina',
            'speed' => 'speed',
            'shooting' => 'shooting',
            'passing' => 'passing',
            'dribbling' => 'dribbling',
            'defense' => 'defense',
            'password' => 'password',
        ];

        $changedFields = array_keys($changes);
        $changedFields = array_map(function ($field) use ($labels) {
            return $labels[$field] ?? str_replace('_', ' ', $field);
        }, $changedFields);

        $fieldList = implode(', ', $changedFields);
        return $base . ': ' . $fieldList;
    }

    private function getModelLabel($model): ?string
    {
        if (isset($model->nama_lengkap) && $model->nama_lengkap) {
            return $model->nama_lengkap;
        }

        if (isset($model->name) && $model->name) {
            return $model->name;
        }

        if (isset($model->nama) && $model->nama) {
            return $model->nama;
        }

        if (isset($model->title) && $model->title) {
            return $model->title;
        }

        return null;
    }
}
