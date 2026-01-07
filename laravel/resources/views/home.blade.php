@extends('layouts.app')

@section('content')
<div class="row">

<div class="col-lg-12">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    @if(count($stokRendah) > 0)
        <div class="alert alert-warning">
            <strong>Perhatian!</strong> Ada {{ count($stokRendah) }} barang dengan stok rendah:
            <ul>
                @foreach($stokRendah as $barang)
                    <li>{{ $barang->nama_barang }} (Stok: {{ $barang->stok }})</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>

        <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Data User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penjualan
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp. {{ number_format($penjualan->sum('subtotal')) }}</div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Keuntungan
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp. {{ number_format($totalKeuntungan) }}</div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Selisih Stok
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalSelisih }}</div>

                                <p>Terakhir Stok Opname <br> {{ $terakhir_stok_opname->tanggal_update }}</p>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
  


    <div class="col-lg-12">
        <form method="GET" action="">
            <label for="month">Bulan:</label>
            <select name="month" id="month">
            <option value="">Select Month</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
             </select>

            <label for="year">Tahun:</label>
            <input type="number" name="year" id="year" value="{{ request('year') ?? date('Y') }}">

            <button type="submit">Filter</button>
        </form>

        <canvas id="salesChart"></canvas>
    </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        // Sample data (replace with your actual data)
        var dates = {!! json_encode($dates) !!};
        var totals = {!! json_encode($totals) !!};

        // Define threshold values for color coding
        var maxTotal = Math.max(...totals);
        var minTotal = Math.min(...totals);

        // Function to determine bar color based on value
        function getColor(value) {
            if (maxTotal === minTotal) {
                
                return `#5f84ed`; 
            }

            var ratio = (value - minTotal) / (maxTotal - minTotal);
            var red = Math.floor(255 * (1 - ratio));
            var green = Math.floor(255 * ratio);
            var blue = 50; // supaya tidak terlalu gelap
            return `rgba(${red}, ${green}, ${blue}, 0.7)`;
        }



        // Generate colors for each bar
        var colors = totals.map(total => getColor(total));

        var ctx = document.getElementById('salesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Total Penjualan',
                    data: totals,
                    backgroundColor: colors,
                    borderColor: colors.map(color => color.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

