
  <head>

    <link rel="stylesheet" href="../sys/bootstrap/plugins/morris/morris.css">
<link rel="stylesheet" href="../sys/bootstrap/ionicons.min.css">
  </head>
  <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>150</h3>
                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
                  <p>Bounce Rate</p>
                </div>
                <div class="icon">
                  <i class="fa fa-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>44</h3>
                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="fa fa-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Unique Visitors</p>
                </div>
                <div class="icon">
                  <i class="fa fa-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
  <div class="row">
            <div class="col-md-12">
              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Bar Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->

    <!-- jQuery 2.1.4 -->
    <script src="../sys/bootstrap/plugins/jQuery/jQuery-2.1.4.min.js"></script>
   
    <!-- Morris.js charts -->
    <script src="../sys/bootstrap/raphael-min.js"></script>
    <script src="../sys/bootstrap/plugins/morris/morris.min.js"></script>
    <!-- FastClick -->
    <?php

// Query untuk mengambil data dari tabel aset
$query = "SELECT kategori.kategori, SUM(aset.jumlah) AS total_jumlah
          FROM aset
          INNER JOIN kategori ON aset.id_kategori = kategori.id_kategori
          GROUP BY aset.id_kategori";

// Eksekusi query
$result = mysqli_query($koneksi, $query);

// Inisialisasi array data untuk chart
$data = array();

// Memasukkan data dari hasil query ke dalam array data
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'y' => $row['kategori'],
        'a' => $row['total_jumlah']
    );
}

?>

<script>
$(function () {
  "use strict";

  //BAR CHART
  var bar = new Morris.Bar({
    element: 'bar-chart',
    resize: true,
    data: <?php echo json_encode($data); ?>,
    barColors: ['#00a65a'],
    xkey: 'y',
    ykeys: ['a'],
    labels: [''],
    hideHover: 'auto'
  });
});
</script>

  </body>
</html>
