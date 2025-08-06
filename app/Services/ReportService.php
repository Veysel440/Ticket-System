<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class ReportService
{
    public function monthlyTicketSummary()
    {
        return Ticket::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')->orderBy('month')
            ->get();
    }

    public function exportTicketsToCsv()
    {
        $tickets = Ticket::select('id', 'title', 'status', 'priority', 'created_at')->get();

        $csv = Writer::createFromString('');
        $csv->insertOne(['ID', 'Başlık', 'Durum', 'Öncelik', 'Tarih']);
        foreach ($tickets as $t) {
            $csv->insertOne([
                $t->id,
                $t->title,
                $t->status,
                $t->priority,
                $t->created_at->format('Y-m-d'),
            ]);
        }

        $fileName = 'exports/tickets_' . now()->format('Ymd_His') . '.csv';
        Storage::put($fileName, $csv->toString());
        return Storage::url($fileName);
    }
}
