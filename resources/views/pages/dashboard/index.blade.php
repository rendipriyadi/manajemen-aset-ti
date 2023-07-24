@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block">Dashboard</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Activity</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hospital Info cards -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="la la-user-md font-large-2 success"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h5 class="text-muted text-bold-500">PC</h5>
                                        <h3 class="text-bold-600">{{ $pc }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="la la-stethoscope font-large-2 warning"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h5 class="text-muted text-bold-500">Monitor</h5>
                                        <h3 class="text-bold-600">{{ $monitor }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="la la-calendar-check-o font-large-2 info"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h5 class="text-muted text-bold-500">Aksesoris</h5>
                                        <h3 class="text-bold-600">{{ $aksesoris }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="la la-bed font-large-2 danger"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h5 class="text-muted text-bold-500">Perangkat Tambahan</h5>
                                        <h3 class="text-bold-600">{{ $perangkat_tambahan }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hospital Info cards Ends -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Grafik Jumlah Asset Per Divisi</div>
                        <div class="card-body">
                            <div id="grafik"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
@push('after-script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script text="text/javascript">
        var divisi = <?php echo json_encode($divisionNames); ?>;
        var total_permintaan = <?php echo json_encode($divisionCounts); ?>;

        Highcharts.chart('grafik', {
            title: {
                text: 'Grafik Jumlah Asset Per Divisi'
            },
            xAxis: {
                categories: Object.values(divisi)
            },
            yAxis: {
                title: {
                    text: 'Total Permintaan'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Divisi',
                data: Object.values(total_permintaan)
            }]
        });
    </script>
@endpush
