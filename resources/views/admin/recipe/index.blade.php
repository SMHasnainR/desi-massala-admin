@extends('admin.layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

        <div class="container-fluid py-4">
            <div class="d-flex justify-content-end">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h5 class="mb-0">Recipe's table</h5>
                                </div>
                                {{-- <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a> --}}
                                @if ($routeName !== "recipes.user")
                                    <a href="{{ route($routeName.'.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">
                                        +&nbsp; Add New Recipe
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body pb-2">
                               
                                <table class="table align-items-center mb-0 data-table">
                                    <thead>
                                        <tr>
                                            @foreach ($columns as $column)
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    {{ $column['label'] }}</th>
                                            @endforeach                  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('end-script')
    <script>
        $(function(){

            // DataTable Config
            let table = $('.data-table').DataTable({
                // responsive: true,
                processing: true,
                // scrollX: true,
                serverSide: true,
                ajax: "{{ route($routeName) }}",
                
                columns:[
                        // {data: 'id', name: 'id'},
                        // {data: 'image', name: 'image', orderable: false, searchable: false},
                        // {data: 'name', name: 'name'},
                        // {data: 'author', name: 'author'},
                        // {data: 'time', name: 'time',orderable: false, searchable: false },
                        // {data: 'category', name: 'category', orderable: false, searchable: false},
                        // {data: 'status', name: 'status'},
                        // {data: 'action', name: 'action', orderable: false, searchable: false},
                    @foreach($columns as $column)
                    {
                        data: '{{ $column['index'] }}',
                        sortable: {{ $column['sortable'] ? "true" : "false" }},
                        name: '{{ $column['name'] }}',
                    },
                    @endforeach
                ],
                drawCallback: function (settings) {
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    if (elems) {
                        elems.forEach(function (html) {
                        var switchery = new Switchery(html, {
                            color: '#49C47C'
                            , secondaryColor: '#dfdfdf'
                            , jackColor: '#fff'
                            , jackSecondaryColor: null
                            , className: 'switchery'
                            , disabled: false
                            , disabledOpacity: 0.5
                            , speed: '0.1s'
                            , size: 'small'
                        });

                        });
                    }
                    $('.js-switch').on('change', function(){
                        let switchInpuEl = $(this);
                        switchInpuEl.siblings().addClass('disabled');

                        let id = $(this).data('id');
                        console.log(id);

                        // Ajax Call to delete the recipe
                        let url = "{{ route('recipe.status',':id') }}";
                        url = url.replace(':id',id);

                        $.ajax({
                            url:url ,
                            method:"post",
                            dataType:'JSON',
                            success:function(data)
                            {
                                if(data.success)
                                {
                                    switchInpuEl.siblings().removeClass('disabled');
                                    Swal.fire(
                                    'Status Updated!',
                                    data.success,
                                    'success'
                                    )
                                }
                                if (data.error){
                                    Swal.fire(
                                    'Failed to update status !',
                                    data.error,
                                    'error');
                                }
                            }
                        });

                    });
                }
            });

            // Delete Confirmation
            $(document).on('click','.delete',function() {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        let id = $(this).data('id');

                        // Ajax Call to delete the recipe
                        let url = "{{ route('recipe.destroy',':id') }}";
                        url = url.replace(':id',id);

                        $.ajax({
                            url:url ,
                            method:"post",
                            dataType:'JSON',
                            success:function(data)
                            {
                                if(data.success)
                                {
                                    table.rows($(this).closest('tr')).remove().draw();
                                    Swal.fire(
                                    'Deleted!',
                                    data.success,
                                    'success'
                                    )
                                }
                                if (data.error){
                                    Swal.fire(
                                    'Cancelled',
                                    data.error,
                                    'error');
                                }
                            }
                        });

                    }
                });

            });

            // Toggle Status
            // $(document).on('click', '.switchery',function(){
            //     console.log('Disabled Input');
            //     $(this).attr('disabled', true);
            // })


        })
    </script>
@endsection
