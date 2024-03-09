@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Employee</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item">Employee</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">LIST OF EMPLOYEE</h5>
                            <div class="col-lg-12 mb-4">
                                <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AddEmployeeModal"><i class="bi bi-plus"></i> New Employee</a>
                            </div>
                            <table class='table table-hover nowrap w-100' id="dt_employee">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Departement</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('pages.employee._add')
    @include('pages.employee._detail')
@endsection

@section('js')
    <script src="{{url('/js/employee.js')}}" type="application/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#departement").select2({
                dropdownParent: $('#AddEmployeeModal'),
                theme: 'bootstrap-5',
                minimumInputLength: 1,
                placeholder: 'Select Departement',
                ajax: {
                    url: '/employee/data-departement',
                    metgot: 'get',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $("#detail_departement").select2({
                dropdownParent: $('#DetailEmployeeModal'),
                theme: 'bootstrap-5',
                minimumInputLength: 1,
                placeholder: 'Select Departement',
                ajax: {
                    url: '/employee/data-departement',
                    metgot: 'get',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
