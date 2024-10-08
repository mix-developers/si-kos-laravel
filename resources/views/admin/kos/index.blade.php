@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label ">
                        <h5 class="card-title mb-0">{{ $title ?? 'Title' }}</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class=" btn-group " role="group">
                            <button class="btn btn-secondary refresh btn-default" type="button">
                                <span>
                                    <i class="bx bx-sync me-sm-1"> </i>
                                    <span class="d-none d-sm-inline-block">Refresh Data</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="datatable-kos" class="table table-hover table-bordered display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama KOS</th>
                                <th>Pemilik</th>
                                <th>Pintu</th>
                                <th>Harga</th>
                                <th>Peruntukan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Lihat Kos</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama KOS</th>
                                <th>Pemilik</th>
                                <th>Pintu</th>
                                <th>Harga</th>
                                <th>Peruntukan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Lihat Kos</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.kos.components.modal')
@endsection
@include('admin.kos.script')
