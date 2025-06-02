<?php
include "header.php";
include "sidebar.php";

$currentYear = date('Y');
$allMonths = [];
for ($i = 1; $i <= 12; $i++) {
    $allMonths[] = $currentYear . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
}

$data = $thanhtoan->HienThiTienTheoThang();
$totalsByMonth = array_fill_keys($allMonths, 0);

foreach ($data as $item) {
    if (isset($totalsByMonth[$item['month']])) {
        $totalsByMonth[$item['month']] = $item['total'];
    }
}

$monthLabels = array_keys($totalsByMonth);
$totals = array_values($totalsByMonth);
$yearlyTotal = array_sum($totals);

// Tìm tháng có doanh thu cao nhất
$maxRevenue = max($totals);
$maxRevenueMonth = array_search($maxRevenue, $totalsByMonth);
$monthName = date('m/Y', strtotime($maxRevenueMonth));
?>

<div id="content">
<div class="container py-3 ">
    <div class="card bg-white shadow-sm mb-4">
        <div class="card-header py-3 bg-white">
            <h2 class="text-center m-0 font-weight-bold text-primary">Biểu Đồ Doanh Thu Năm <?php echo $currentYear ?></h2>
        </div>
        <div class="card-body">
            <canvas id="revenueChart" style="height: 400px; width: 100%;"></canvas>
        </div>
    </div>

    <h3 class="mb-4">Tổng doanh thu trong năm: <span class="text-primary font-weight-bold"><?php echo number_format($yearlyTotal, 0, ',', '.') ?> VNĐ</span></h3>
    <h5>Tháng doanh thu cao nhất: 
                        <span class="text-success font-weight-bold"><?php echo number_format($maxRevenue, 0, ',', '.') ?> VNĐ</span>
                        <small class="text-muted">(Tháng <?php echo $monthName ?>)</small>
                    </h5>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($monthLabels); ?>,
        datasets: [{
            label: 'Doanh Thu (VNĐ)',
            data: <?php echo json_encode($totals); ?>,
            borderColor: '#4e73df',
            backgroundColor: 'rgba(78, 115, 223, 0.05)',
            borderWidth: 3,
            pointRadius: 5,
            pointBackgroundColor: '#4e73df',
            pointBorderColor: '#fff',
            pointHoverRadius: 7,
            pointHoverBackgroundColor: '#2e59d9',
            pointHoverBorderColor: '#fff',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let value = context.raw;
                        return 'Doanh Thu: ' +  value.toLocaleString('vi-VN') + ' VNĐ';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toLocaleString('vi-VN') + ' VNĐ';
                    }
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>

<?php include "footer.php"; ?>