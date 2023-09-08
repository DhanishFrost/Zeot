<?php

namespace App\Http\Livewire;

use App\Models\RevenueMetric;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class RevenueMetrics extends Component
{
    public $revenueMetrics;
    public $monthlyTrend;
    public $halfYearTrend;
    public $selectedBrand;
    public $revenueByCategory;
    public $revenueByBrand;
    public $selectedPeriod = 'last7days';

    public function initialize()
    {
        $this->updateGraphData();
    }

    public function totalRevenue()
    {
        return RevenueMetric::sum('total_revenue');
    }

    public function revenueTrend($period)
    {
        $monthlyPeriod = [
            now()->startOfMonth()->format('Y-m-d H:i:s'),
            now()->endOfMonth()->format('Y-m-d H:i:s'),
        ];


        $halfYearPeriod = [
            now()->subMonths(6)->startOfMonth()->format('Y-m-d H:i:s'),
            now()->format('Y-m-d H:i:s'),
        ];


        if ($period === 'monthly') {
            $monthlyRevenue = RevenueMetric::whereBetween('date', $monthlyPeriod)->sum('total_revenue');
            return $monthlyRevenue > 0 ? $monthlyRevenue : 0.00;
        } elseif ($period === 'half-year') {
            $halfYearRevenue = RevenueMetric::whereBetween('date', $halfYearPeriod)->sum('total_revenue');
            return $halfYearRevenue > 0 ? $halfYearRevenue : 0.00;
        }
    }



    public function revenueTrendPercentage($period)
    {

        $monthlyPeriod = [
            now()->startOfMonth()->format('Y-m-d H:i:s'),
            now()->endOfMonth()->format('Y-m-d H:i:s'),
        ];
        $subMonth = [
            now()->subMonth()->startOfMonth()->format('Y-m-d H:i:s'),
            now()->endOfMonth()->subMonth()->endOfMonth()->format('Y-m-d H:i:s'),
        ];

        $halfYearPeriod = [
            now()->subMonths(6)->startOfMonth()->format('Y-m-d H:i:s'),
            now()->format('Y-m-d H:i:s'),
        ];

        $subHalfYear = [
            now()->subMonths(11)->startOfMonth()->format('Y-m-d H:i:s'),
            now()->subMonths(6)->endOfMonth()->format('Y-m-d H:i:s'),
        ];

        if ($period === 'monthly') {
            $currentMonthRevenue = RevenueMetric::whereBetween('date', $monthlyPeriod)->sum('total_revenue');
            $previousMonthRevenue = RevenueMetric::whereBetween('date', $subMonth)->sum('total_revenue');
            if ($previousMonthRevenue === 0) {
                return 100;
            }

            return round(($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue * 100);
        } elseif ($period === 'half-year') {
            $currentQuarterRevenue = RevenueMetric::whereBetween('date', $halfYearPeriod)->sum('total_revenue');
            $previousQuarterRevenue = RevenueMetric::whereBetween('date', $subHalfYear)->sum('total_revenue');

            if ($previousQuarterRevenue === 0) {
                return 100;
            }
            return round(($currentQuarterRevenue - $previousQuarterRevenue) / $previousQuarterRevenue * 100);
        }
    }


    public function updateGraphData()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now();
        $data = [];
        $labels = [];

        switch ($this->selectedPeriod) {
            case 'yesterday':
                $startDate->subDay();
                $labelFormat = 'H:i';
                $step = '3 hour';
                break;
            case 'last7days':
                $startDate->subDays(7);
                $labelFormat = 'D';
                $step = '1 day';
                break;
            case 'last30days':
                $startDate->subDays(30);
                $labelFormat = 'D';
                $step = '1 day';
                break;
            case 'last3months':
                $startDate->subMonths(3)->startOfMonth();
                $labelFormat = 'M d';
                $step = '1 week';
                break;
            case 'last6months':
                $startDate->subMonths(6)->startOfMonth();
                $labelFormat = 'M d';
                $step = '2 weeks';
                break;
            case 'last12months':
                $startDate->subMonths(12)->startOfMonth();
                $labelFormat = 'M';
                $step = '1 month';
                break;
            default: // 'today'
                $startDate->startOfDay();
                $labelFormat = 'H:i';
                $step = '1 hour';
                break;
        }

        $currentDate = $endDate->clone();

        while ($currentDate >= $startDate) {
            $labels[] = $currentDate->format($labelFormat);
            $data[] = RevenueMetric::where('date', '<=', $currentDate)
                ->where('date', '>=', $currentDate->copy()->sub($step))
                ->sum('total_revenue');
            $currentDate->sub($step);
        }                               
        $labels = array_reverse($labels);
        $data = array_reverse($data);
        $this->emit('updateGraph', $labels, $data);
    }

    public function getAverageOrderValue()
    {
        $totalRevenue = Order::sum('total_price');

        $totalOrders = Order::all()->count();

        if ($totalOrders > 0) {
            $aov = $totalRevenue / $totalOrders;
        } else {
            $aov = 0;
        }

        return number_format($aov, 2); 
    }





    public function render()
    {

        $this->revenueByCategory = RevenueMetric::selectRaw('category, SUM(total_revenue) as total_revenue')
            ->groupBy('category')
            ->orderBy('total_revenue', 'desc')
            ->get();

        $this->revenueByBrand = RevenueMetric::selectRaw('brand, SUM(total_revenue) as total_revenue')
            ->groupBy('brand')
            ->orderBy('total_revenue', 'desc')
            ->get();
        $this->revenueMetrics = RevenueMetric::orderBy('date', 'asc')->get();
        return view(
            'livewire.revenue-metrics',
        );
    }
}
