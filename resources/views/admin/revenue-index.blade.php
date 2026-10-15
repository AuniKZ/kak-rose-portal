@extends('admin.admin')

@section('title', 'Sales & Revenue Report - Kak Rose Admin')

@section('content')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div>
    <h2 class="font-serif-title text-3xl font-bold text-[#1B3629]">Sales & Revenue Report</h2>
    <p class="text-[#706B63] text-sm mt-0.5">Real-time revenue tracking and monthly financial trends generated from completed bookings.</p>
</div>

<!-- KPI Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="bg-white p-5 rounded-2xl border border-[#E2DDD5] shadow-sm">
        <span class="text-[11px] font-bold text-[#706B63] uppercase tracking-wider block">Total Sales Revenue</span>
        <span class="text-2xl font-bold text-[#122A21] mt-1 block">RM {{ number_format($totalRevenue, 2) }}</span>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-[#E2DDD5] shadow-sm">
        <span class="text-[11px] font-bold text-[#706B63] uppercase tracking-wider block">Completed Transactions</span>
        <span class="text-2xl font-bold text-[#1B3629] mt-1 block">{{ $totalTransactions }}</span>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-[#E2DDD5] shadow-sm">
        <span class="text-[11px] font-bold text-[#706B63] uppercase tracking-wider block">Average Spend / Session</span>
        <span class="text-2xl font-bold text-[#122A21] mt-1 block">RM {{ number_format($averageTicket, 2) }}</span>
    </div>
</div>

<!-- Modern Line/Area Graph Card -->
<div x-data="{ showInfo: false, showDateRange: false }" class="bg-white p-6 rounded-3xl border border-[#E2DDD5] shadow-sm space-y-4 relative">
    <div class="flex flex-wrap items-center justify-between gap-4">
        
        <!-- Header & Interactive Info Icon -->
        <div class="flex items-center gap-2 relative">
            <h3 class="font-serif-title font-bold text-xl text-[#122A21]">
                {{ ucfirst($period ?? 'Month') }}ly Revenue
            </h3>
            
            <!-- Info Icon Button -->
            <button @click="showInfo = !showInfo" @click.away="showInfo = false" 
                    type="button" 
                    class="w-5 h-5 rounded-full border border-[#8C7A6B] text-[#8C7A6B] hover:text-[#122A21] hover:border-[#122A21] text-[11px] font-bold flex items-center justify-center transition cursor-pointer" 
                    title="Click for calculation details">
                i
            </button>

            <!-- Info Tooltip Popover Box -->
            <div x-show="showInfo" x-transition 
                 class="absolute left-0 top-8 z-20 w-72 p-4 bg-[#122A21] text-white rounded-2xl shadow-xl text-xs space-y-2 border border-[#1B3629]">
                <div class="font-bold text-[#D4AF37] border-b border-[#1B3629] pb-1">Revenue Calculation Method</div>
                <p class="text-[#E2DDD5] leading-relaxed">
                    Revenue is computed dynamically in real-time by aggregating completed appointment fees based on assigned package rates.
                </p>
                <div class="text-[10px] text-[#A3B899]">Formula: Sum(Completed Sessions &times; Package Price)</div>
            </div>
        </div>

        <!-- Period Selector Filter Buttons (Dynamic Active Highlight) -->
        <div class="inline-flex p-1 bg-[#F4F1EA] border border-[#E2DDD5] rounded-2xl text-xs font-semibold text-[#706B63]">
            
            <a href="{{ route('admin.revenue.index', ['period' => 'day']) }}" 
            class="px-3 py-1.5 rounded-xl transition {{ request('period', $period ?? 'month') === 'day' ? 'bg-white text-[#122A21] font-bold shadow-sm' : 'hover:text-[#122A21]' }}">
                Day
            </a>

            <a href="{{ route('admin.revenue.index', ['period' => 'week']) }}" 
            class="px-3 py-1.5 rounded-xl transition {{ request('period', $period ?? 'month') === 'week' ? 'bg-white text-[#122A21] font-bold shadow-sm' : 'hover:text-[#122A21]' }}">
                Week
            </a>

            <a href="{{ route('admin.revenue.index', ['period' => 'month']) }}" 
            class="px-3 py-1.5 rounded-xl transition {{ request('period', $period ?? 'month') === 'month' ? 'bg-white text-[#122A21] font-bold shadow-sm' : 'hover:text-[#122A21]' }}">
                Month
            </a>

            <a href="{{ route('admin.revenue.index', ['period' => 'year']) }}" 
            class="px-3 py-1.5 rounded-xl transition {{ request('period', $period ?? 'month') === 'year' ? 'bg-white text-[#122A21] font-bold shadow-sm' : 'hover:text-[#122A21]' }}">
                Year
            </a>

            <button @click="showDateRange = true" type="button" 
                    class="px-3 py-1.5 rounded-xl transition {{ request('period', $period ?? 'month') === 'range' ? 'bg-white text-[#122A21] font-bold shadow-sm' : 'hover:text-[#122A21]' }}">
                Date Range
            </button>

        </div>

    <!-- Date Range Picker Modal -->
    <div x-show="showDateRange" x-transition class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4">
        <div @click.away="showDateRange = false" class="bg-white p-6 rounded-3xl border border-[#E2DDD5] shadow-2xl max-w-sm w-full space-y-4">
            <h4 class="font-serif-title font-bold text-lg text-[#122A21]">Select Custom Date Range</h4>
            <form method="GET" action="{{ route('admin.revenue.index') }}" class="space-y-3 text-xs">
                <input type="hidden" name="period" value="range">
                <div>
                    <label class="block font-bold text-[#706B63] mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" required class="w-full p-2.5 rounded-xl border border-[#E2DDD5] focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-[#706B63] mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" required class="w-full p-2.5 rounded-xl border border-[#E2DDD5] focus:outline-none">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="showDateRange = false" class="px-3 py-2 rounded-xl border border-[#E2DDD5] font-semibold text-[#706B63]">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#122A21] text-[#D4AF37] font-bold rounded-xl shadow-sm">Apply Range</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Chart Canvas -->
    <div class="relative w-full h-80 pt-2">
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<!-- AlpineJS CDN for Tooltip & Modal toggles -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Service Package Breakdown -->
<div class="bg-white p-5 rounded-2xl border border-[#E2DDD5] shadow-sm">
    <h3 class="font-serif-title font-bold text-lg text-[#122A21] mb-4">Revenue Breakdown by Service Package</h3>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        @foreach($serviceBreakdown as $serviceTitle => $data)
            <div class="p-4 bg-[#FAF8F5] border border-[#E2DDD5] rounded-xl">
                <span class="font-bold text-sm text-[#122A21] block">{{ $serviceTitle }}</span>
                <span class="text-xs text-[#8C7A6B] block mt-0.5">{{ $data['count'] }} Completed Booking(s)</span>
                <span class="text-base font-bold text-[#166534] mt-2 block">RM {{ number_format($data['total'], 2) }}</span>
            </div>
        @endforeach
    </div>
</div>

<!-- Completed Sales Ledger Table -->
<div class="bg-white border border-[#E2DDD5] rounded-2xl shadow-sm overflow-hidden">
    <div class="p-4 border-b border-[#E2DDD5] bg-[#FCFCFA]">
        <h3 class="font-serif-title font-bold text-lg text-[#122A21]">Completed Sales Ledger</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
            <thead>
                <tr class="bg-[#F8F6F0] text-[#706B63] uppercase text-[11px] tracking-wider border-b border-[#E2DDD5]">
                    <th class="p-4 font-bold">Date & Time</th>
                    <th class="p-4 font-bold">Client Name</th>
                    <th class="p-4 font-bold">Service Package</th>
                    <th class="p-4 font-bold">Revenue Earned</th>
                    <th class="p-4 font-bold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E2DDD5]">
                @forelse($completedAppointments as $app)
                <tr class="hover:bg-[#FAF8F5]">
                    <td class="p-4 font-medium text-[#122A21]">
                        {{ \Carbon\Carbon::parse($app->appointment_date ?? $app->start_time)->format('d M Y') }}
                    </td>
                    <td class="p-4 font-bold text-[#122A21]">
                        {{ $app->user->name ?? 'Guest' }}
                    </td>
                    <td class="p-4">
                        {{ $app->service->title ?? $app->service->name ?? 'Service' }}
                    </td>
                    <td class="p-4 font-bold text-[#166534]">
                        RM {{ number_format($app->service->price ?? 0, 2) }}
                    </td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 bg-[#DCFCE7] text-[#166534] rounded-lg text-[10px] font-bold uppercase tracking-wider">
                            PAID & COMPLETED
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-[#8C7A6B]">
                        No completed sales records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Script to Render Modern Area Chart with Vertical Line -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rawLabels = {!! json_encode($chartLabels ?? []) !!};
        const rawValues = {!! json_encode($chartValues ?? []) !!};

        const labels = Array.isArray(rawLabels) && rawLabels.length > 0 ? rawLabels : ['01 Oct', '04 Oct', '07 Oct'];
        const values = Array.isArray(rawValues) && rawValues.length > 0 ? rawValues.map(v => Number(v)) : [2800, 4200, 9140];

        const canvas = document.getElementById('revenueChart');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');

        // Soft Gradient Fill
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(27, 54, 41, 0.25)');
        gradient.addColorStop(0.8, 'rgba(27, 54, 41, 0.01)');

        // Custom Crosshair Plugin for Vertical Line on Hover
        const verticalLinePlugin = {
            id: 'verticalLine',
            beforeDraw: (chart) => {
                if (chart.tooltip?._active?.length) {
                    const activePoint = chart.tooltip._active[0];
                    const { ctx } = chart;
                    const x = activePoint.element.x;
                    const topY = chart.scales.y.top;
                    const bottomY = chart.scales.y.bottom;

                    ctx.save();
                    ctx.beginPath();
                    ctx.moveTo(x, topY);
                    ctx.lineTo(x, bottomY);
                    ctx.lineWidth = 1.5;
                    ctx.strokeStyle = '#122A21';
                    ctx.stroke();
                    ctx.restore();
                }
            }
        };

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: values,
                    borderColor: '#1B3629',
                    borderWidth: 2.5,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.35,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#1B3629',
                    pointHoverBorderColor: '#FFFFFF',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#FFFFFF',
                        titleColor: '#8C7A6B',
                        bodyColor: '#122A21',
                        borderColor: '#E2DDD5',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 16,
                        displayColors: false,
                        titleFont: { family: 'Plus Jakarta Sans', size: 11, weight: '500' },
                        bodyFont: { family: 'Plus Jakarta Sans', size: 16, weight: '700' },
                        callbacks: {
                            title: function(items) {
                                return items[0].label;
                            },
                            label: function(context) {
                                return 'RM ' + Number(context.raw).toLocaleString('en-US', { minimumFractionDigits: 2 });
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return 'RM ' + (value >= 1000 ? (value / 1000).toFixed(0) + 'k' : value);
                            },
                            font: { family: 'Plus Jakarta Sans', size: 11 },
                            color: '#8C7A6B'
                        },
                        grid: {
                            color: '#E2DDD5',
                            borderDash: [4, 4],
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 11 },
                            color: '#8C7A6B'
                        },
                        grid: { display: false }
                    }
                }
            },
            plugins: [verticalLinePlugin]
        });
    });
</script>
@endsection