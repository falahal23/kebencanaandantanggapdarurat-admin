<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ $judul ?? 'Tanggap Darurat' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f4f7fb; }
    .card-header { font-weight:700; }
    .key { width: 30%; text-transform: capitalize; }
  </style>
</head>
<body>
<div class="container my-5">
  <h1 class="text-center text-primary mb-4">{{ $judul ?? 'Tanggap Darurat' }}</h1>

  @php
    // helper kecil: render section jika data ada
    function render_table($title, $arr, $color='secondary') {
      if(!isset($arr) || !is_array($arr)) return;
      echo '<div class="card mb-4 shadow-sm"><div class="card-header bg-'.$color.' text-white">'.$title.'</div><div class="card-body"><table class="table table-borderless">';
      foreach($arr as $k => $v){
        echo '<tr><th class="key text-muted">'.str_replace('_',' ',$k).'</th><td>';
        if($k === 'nilai' && is_numeric($v)) {
          echo 'Rp '.number_format($v,0,',','.');
        } else {
          echo e($v);
        }
        echo '</td></tr>';
      }
      echo '</table></div></div>';
    }
  @endphp

  {!! render_table('Kejadian Bencana', $kejadian_bencana, 'danger') !!}
  {!! render_table('Posko Bencana', $posko_bencana, 'warning') !!}
  {!! render_table('Donasi Bencana', $donasi_bencana, 'success') !!}
  {!! render_table('Logistik Bencana', $logistik_bencana, 'info') !!}
  {!! render_table('Distribusi Logistik', $distribusi_logistik, 'primary') !!}

  <div class="text-center mt-3">
    <a href="{{ url('/') }}" class="btn btn-outline-primary">Kembali ke Home</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
