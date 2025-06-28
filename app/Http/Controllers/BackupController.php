<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

class BackupController extends Controller
{
    public function index()
    {
        $backups = $this->getBackupFiles();
        return view('backup.index', compact('backups'));
    }

    public function create()
    {
        try {
            // Generate backup filename
            $filename = 'backup_' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';

            // Create backup directory if not exists
            $backupPath = storage_path('app/backups');
            if (!file_exists($backupPath)) {
                mkdir($backupPath, 0755, true);
            }

            // Database configuration
            $host = config('database.connections.mysql.host');
            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');

            // Create backup command
            $command = "mysqldump -h {$host} -u {$username}";
            if ($password) {
                $command .= " -p{$password}";
            }
            $command .= " {$database} > {$backupPath}/{$filename}";

            // Execute backup
            exec($command, $output, $returnCode);

            if ($returnCode === 0) {
                return redirect()->route('backup.index')
                    ->with('success', 'Backup database berhasil dibuat!');
            } else {
                return redirect()->route('backup.index')
                    ->with('error', 'Gagal membuat backup database!');
            }
        } catch (\Exception $e) {
            return redirect()->route('backup.index')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        $filePath = storage_path('app/backups/' . $filename);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->route('backup.index')
            ->with('error', 'File backup tidak ditemukan!');
    }

    public function delete($filename)
    {
        $filePath = storage_path('app/backups/' . $filename);

        if (file_exists($filePath)) {
            unlink($filePath);
            return redirect()->route('backup.index')
                ->with('success', 'File backup berhasil dihapus!');
        }

        return redirect()->route('backup.index')
            ->with('error', 'File backup tidak ditemukan!');
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:sql'
        ]);

        try {
            $file = $request->file('backup_file');
            $tempPath = $file->getRealPath();

            // Database configuration
            $host = config('database.connections.mysql.host');
            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');

            // Create restore command
            $command = "mysql -h {$host} -u {$username}";
            if ($password) {
                $command .= " -p{$password}";
            }
            $command .= " {$database} < {$tempPath}";

            // Execute restore
            exec($command, $output, $returnCode);

            if ($returnCode === 0) {
                return redirect()->route('backup.index')
                    ->with('success', 'Database berhasil dipulihkan!');
            } else {
                return redirect()->route('backup.index')
                    ->with('error', 'Gagal memulihkan database!');
            }
        } catch (\Exception $e) {
            return redirect()->route('backup.index')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    private function getBackupFiles()
    {
        $backupPath = storage_path('app/backups');
        $files = [];

        if (file_exists($backupPath)) {
            $backupFiles = glob($backupPath . '/*.sql');

            foreach ($backupFiles as $file) {
                $filename = basename($file);
                $files[] = [
                    'filename' => $filename,
                    'size' => $this->formatBytes(filesize($file)),
                    'created_at' => Carbon::createFromTimestamp(filemtime($file))->format('d/m/Y H:i:s'),
                    'path' => $file
                ];
            }

            // Sort by creation time (newest first)
            usort($files, function ($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });
        }

        return $files;
    }

    private function formatBytes($size, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }

        return round($size, $precision) . ' ' . $units[$i];
    }
}
