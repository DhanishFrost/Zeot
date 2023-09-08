<?php

namespace App\Http\Livewire;

use App\Models\UserVisit;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserEngagementMetrics extends Component
{
    public $selectedPeriod = 'last7days';
    public $totalNumberOfVisits = 0;
    public $retentionRate = 0;

    public function mount()
    {
        $this->updateUserVisitGraphData();
    }

    public function initialize()
    {
        $this->updateUserVisitGraphData();
    }

    public function updateUserVisitGraphData()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now();
        $userVisitData = [];
        $userVisitLabels = [];

        switch ($this->selectedPeriod) {
            case 'last7days':
                $startDate->subDays(7);
                $labelFormat = 'd M';
                $step = '1 day';
                break;
            case 'last30days':
                $startDate->subDays(30);
                $labelFormat = 'd M';
                $step = '1 day';
                break;
            case 'last3months':
                $startDate->subMonths(3)->startOfMonth();
                $labelFormat = 'd M';
                $step = '1 week';
                break;
            case 'last6months':
                $startDate->subMonths(6)->startOfMonth();
                $labelFormat = 'M Y';
                $step = '1 month';
                break;
            case 'last12months':
                $startDate->subMonths(12)->startOfMonth();
                $labelFormat = 'M Y';
                $step = '1 month';
                break;
            default:
                'today';
                break;
        }

        $currentDate = $endDate->clone();
            
        while ($currentDate >= $startDate) {
            $formattedDate = $currentDate->format($labelFormat);

            $visitsForDate = UserVisit::where('visited_at', '<=', $currentDate)
                ->where('visited_at', '>=', $currentDate->copy()->sub($step))
                ->sum('number_of_visits');

            $currentDate->sub($step);
            $userVisitLabels[] = $formattedDate;
            $userVisitData[] = $visitsForDate;

            
        }

        $userVisitLabels = array_reverse($userVisitLabels);
        $userVisitData = array_reverse($userVisitData);

        $this->totalNumberOfVisits = array_sum($userVisitData);

        $initialCustomers = UserVisit::whereDate('visited_at', '>=', $startDate)
            ->distinct('user_id')
            ->pluck('user_id');

        $returningCustomers = UserVisit::whereDate('visited_at', '<', $startDate)
            ->whereIn('user_id', $initialCustomers)
            ->distinct('user_id')
            ->pluck('user_id');

        if (count($initialCustomers) == 0) {
            return 0.00;
        }

        $this->retentionRate = count($returningCustomers) / count($initialCustomers) * 100;

        $this->emit('userVisitUpdateGraph', $userVisitLabels, $userVisitData);
    }
   


    public function render()
    {
        return view('livewire.user-engagement-metrics', [
            // 'totalNumberOfVisits' => $this->totalNumberOfVisits,
        ]);
    }
}
