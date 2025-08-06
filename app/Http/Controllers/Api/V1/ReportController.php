<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(protected ReportService $service)
    {
        $this->middleware(['auth:sanctum', 'role:admin']);
    }

    public function monthlyTicketSummary()
    {
        return response()->json($this->service->monthlyTicketSummary());
    }

    public function exportTicketsToCsv()
    {
        $url = $this->service->exportTicketsToCsv();
        return response()->json(['download_url' => $url]);
    }

    public function ticketStatusSummary()
    {
        return response()->json($this->service->ticketStatusSummary());
    }

    public function agentPerformance()
    {
        return response()->json($this->service->agentPerformance());
    }
}
