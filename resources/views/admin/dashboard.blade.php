@extends('admin.layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Recipes</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $userRecipeCount + $adminRecipeCount }}
                                    {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-utensils text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Categories</p>
                                <h5 class="font-weight-bolder mb-0">
                                  {{ $categoryCount }}
                                  {{-- <span class="text-success text-sm font-weight-bolder">+3%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Admin Recipes</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $adminRecipeCount }}
                                    {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-utensils text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Users Recipes</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $userRecipeCount }}
                                    {{-- <span class="text-success text-sm font-weight-bolder">+5%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-utensils text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Recipes Table --}}
    <div class="row my-4">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Recent Recipes</h6>
                            <p class="text-sm mb-0">
                                {{-- <i class="fa fa-check text-info" aria-hidden="true"></i> --}}
                                {{-- <span class="font-weight-bold ms-1">12 added</span> this month --}}
                            </p>
                        </div>

                        {{-- ! Three dots actiom button --}}

                        {{-- <div class="col-lg-6 col-5 my-auto text-end">
                            <div class="dropdown float-lg-end pe-4">
                                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                </a>
                                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a>
                                    </li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else
                                            here</a></li>
                                </ul>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <div class="table-responsive">

                        <table class="table align-items-center mb-0 data-table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NO</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Img</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Recipes</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Author</th>
                                    <th
                                        class="tebnxt-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Time</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Category</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Category</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                {{-- <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/recipe/recipe-1.png"
                                                    class="avatar avatar-sm me-3" alt="xd">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Arroz Con Pollo</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                      <span class="text-xs font-weight-bold"> Admin </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> 10 - 15 min </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        Vegetable
                                    </td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('dashboard')
    <script>
        window.onload = function() {
            // var ctx = document.getElementById("chart-bars").getContext("2d");

            // new Chart(ctx, {
            //     type: "bar",
            //     data: {
            //         labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            //         datasets: [{
            //             label: "Sales",
            //             tension: 0.4,
            //             borderWidth: 0,
            //             borderRadius: 4,
            //             borderSkipped: false,
            //             backgroundColor: "#fff",
            //             data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
            //             maxBarThickness: 6
            //         }, ],
            //     },
            //     options: {
            //         responsive: true,
            //         maintainAspectRatio: false,
            //         plugins: {
            //             legend: {
            //                 display: false,
            //             }
            //         },
            //         interaction: {
            //             intersect: false,
            //             mode: 'index',
            //         },
            //         scales: {
            //             y: {
            //                 grid: {
            //                     drawBorder: false,
            //                     display: false,
            //                     drawOnChartArea: false,
            //                     drawTicks: false,
            //                 },
            //                 ticks: {
            //                     suggestedMin: 0,
            //                     suggestedMax: 500,
            //                     beginAtZero: true,
            //                     padding: 15,
            //                     font: {
            //                         size: 14,
            //                         family: "Open Sans",
            //                         style: 'normal',
            //                         lineHeight: 2
            //                     },
            //                     color: "#fff"
            //                 },
            //             },
            //             x: {
            //                 grid: {
            //                     drawBorder: false,
            //                     display: false,
            //                     drawOnChartArea: false,
            //                     drawTicks: false
            //                 },
            //                 ticks: {
            //                     display: false
            //                 },
            //             },
            //         },
            //     },
            // });


            // var ctx2 = document.getElementById("chart-line").getContext("2d");

            // var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            // gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            // gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            // gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            // var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            // gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            // gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            // gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            // new Chart(ctx2, {
            //     type: "line",
            //     data: {
            //         labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            //         datasets: [{
            //                 label: "Mobile apps",
            //                 tension: 0.4,
            //                 borderWidth: 0,
            //                 pointRadius: 0,
            //                 borderColor: "#cb0c9f",
            //                 borderWidth: 3,
            //                 backgroundColor: gradientStroke1,
            //                 fill: true,
            //                 data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            //                 maxBarThickness: 6

            //             },
            //             {
            //                 label: "Websites",
            //                 tension: 0.4,
            //                 borderWidth: 0,
            //                 pointRadius: 0,
            //                 borderColor: "#3A416F",
            //                 borderWidth: 3,
            //                 backgroundColor: gradientStroke2,
            //                 fill: true,
            //                 data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            //                 maxBarThickness: 6
            //             },
            //         ],
            //     },
            //     options: {
            //         responsive: true,
            //         maintainAspectRatio: false,
            //         plugins: {
            //             legend: {
            //                 display: false,
            //             }
            //         },
            //         interaction: {
            //             intersect: false,
            //             mode: 'index',
            //         },
            //         scales: {
            //             y: {
            //                 grid: {
            //                     drawBorder: false,
            //                     display: true,
            //                     drawOnChartArea: true,
            //                     drawTicks: false,
            //                     borderDash: [5, 5]
            //                 },
            //                 ticks: {
            //                     display: true,
            //                     padding: 10,
            //                     color: '#b2b9bf',
            //                     font: {
            //                         size: 11,
            //                         family: "Open Sans",
            //                         style: 'normal',
            //                         lineHeight: 2
            //                     },
            //                 }
            //             },
            //             x: {
            //                 grid: {
            //                     drawBorder: false,
            //                     display: false,
            //                     drawOnChartArea: false,
            //                     drawTicks: false,
            //                     borderDash: [5, 5]
            //                 },
            //                 ticks: {
            //                     display: true,
            //                     color: '#b2b9bf',
            //                     padding: 20,
            //                     font: {
            //                         size: 11,
            //                         family: "Open Sans",
            //                         style: 'normal',
            //                         lineHeight: 2
            //                     },
            //                 }
            //             },
            //         },
            //     },
            // });

            //  Datatable Initialized

            // DataTable Config
            let table = $('.data-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard') }}",
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'author', name: 'author'},
                    {data: 'time', name: 'time',orderable: false, searchable: false },
                    {data: 'category', name: 'category', orderable: false, searchable: false},
                    // {data: 'status', name: 'status'},
                    // {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


        }
    </script>
@endpush
