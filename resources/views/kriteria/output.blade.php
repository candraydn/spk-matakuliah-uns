@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Perhitungan Bobot Kriteria</div>
                <div class="card-body">
                    <h2>Matriks Perbandingan Berpasangan</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                @foreach ($kriteria as $k)
                                    <th>{{$k['nama_kriteria']}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x=0;
                            @endphp
                            @foreach ($kriteria as $k)    
                                <tr>
                                    <th>{{$k['nama_kriteria']}}</th>
                                    @php
                                        for ($y=0; $y <= ($n-1); $y++) { 
                                            echo "<td>".round($matrik[$x][$y],5)."</td>";
                                        }
                                        $x++;
                                    @endphp
                                </tr>
                            @endforeach
                            <thead class="thead-dark">
                                <tr>
                                    <th>Jumlah</th>
                                    @php
                                        for ($i=0; $i <= ($n-1); $i++) { 
                                            echo "<th>".round($jmlmpb[$i],5)."</th>";
                                        }
                                        @endphp 
                                </tr>
                            </thead>
                        </tbody>
                    </table>
                    <br>
                    <h2>Matriks Nilai Kriteria</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                @foreach ($kriteria as $k)
                                    <th>{{$k['nama_kriteria']}}</th>
                                @endforeach
                                <th>Jumlah</th>
                                <th>Priority Vector</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x=0;
                            @endphp
                            @foreach ($kriteria as $k)    
                                <tr>
                                    <th>{{$k['nama_kriteria']}}</th>
                                    @php
                                        for ($y=0; $y <= ($n-1); $y++) { 
                                            echo "<td>".round($matrikb[$x][$y],5)."</td>";
                                        }
                                        echo "<td>".round($jmlmnk[$x],5)."</td>";
		                                echo "<td>".round($pv[$x],5)."</td>";
                                        $x++;
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="<?php echo ($n+2)?>" style="text-align: center">Principe Eigen Vector (λ maks)</th>
                                <th><?php echo (round($eigenvektor,5))?></th>
                            </tr>
                            <tr>
                                <th colspan="<?php echo ($n+2)?>" style="text-align: center">Consistency Index</th>
                                <th><?php echo (round($consIndex,5))?></th>
                            </tr>
                            <tr>
                                <th colspan="<?php echo ($n+2)?>" style="text-align: center">Consistency Ratio</th>
                                <th><?php echo (round(($consRatio * 100),2))?> %</th>
                            </tr>
                        </thead>
                    </table>
                    @if ($consRatio > 0.1)
                        <div class="alert alert-danger" role="alert">
                            <b>Error.. </b> Niali <i> Consistency Ratio </i> melebihi 10%, silakan perbaiki lagi
                        </div>
                        <a class="btn btn-warning" href='javascript:history.back()'><< Kembali</a>
                    @else
                        <a class="btn btn-success" href="#">Lanjut</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
@endsection
