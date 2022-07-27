@extends('layouts.panel')

@section('title', 'Admin Panel')

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Transaksi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Transaksi</h5>

                            <div class="row input-daterange ml-2 my-2">
                                <div class="col-md-3">
                                    <input type="date" name="from_date" id="from_date" value="{{ date('Y-m-d', strtotime('-7 days')) }}" class="form-control"
                                        placeholder="From Date" />
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="to_date" id="to_date"  value="{{ date('Y-m-d') }}" class="form-control"
                                        placeholder="To Date" />
                                </div>
                                <div class="col-md-3">
                                    <select name="status_transaksi" id="status_transaksi" class="form-control">
                                        <option value="SEMUA">SEMUA</option>
                                        <option value="PENDING">PENDING</option>
                                        <option value="SELESAI">SELESAI</option>
                                        <option value="ON PROGRESS">ON PROGRESS</option>
                                        <option value="SUDAH BAYAR">SUDAH BAYAR</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                    <button type="button"  name="refresh" id="refresh"
                                        class="btn btn-secondary">Refresh</button>
                                </div>

                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table" id="table-data">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">Tanggal Transaksi</th>
                                            <th>Kode Transaksi</th>
                                            <th>Nama Customer</th>
                                            <th>Paket Travel</th>
                                            <th>Peserta</th>
                                            <th>Status</th>
                                            <th>Total Harga</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6">Total</th>
                                            <th id="total"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->



@endsection
@push('down-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush
@push('down-script')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
       <script>
        $(document).ready(function() {
           function numberWithCommas(x) {
           return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
           }
           var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
           var from_date = $('#from_date').val();
           var to_date = $('#to_date').val();
           load_data(from_date, to_date, status_transaksi);
           $('#filter').click(function() {
               var from_date = $('#from_date').val();
               var to_date = $('#to_date').val();
               var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
               if (from_date != '' && to_date != '') {
                   $('#table-data').DataTable().destroy();
                   load_data(from_date, to_date, status_transaksi);
               } else {
                   alert('Silahkan Pilih Tanggal')
               }
           });
           $('#refresh').click(function() {
               var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
               var from_date = $('#from_date').val();
               var to_date = $('#to_date').val();
               $('#table-data').DataTable().destroy();
               load_data(from_date, to_date, status_transaksi);
           });
           function load_data(from_date = '', to_date = '', status_transaksi = '') {
               var datatable = $('#table-data').DataTable({
                   processing: true,
                   serverSide: true,
                   ordering: true,
                   ajax: {
                       url: '{!! url()->current() !!}',
                       type: 'GET',
                       data: {
                           from_date: from_date,
                           to_date: to_date,
                           status_transaksi: status_transaksi,
                       }
                   },
                   dom: 'Bfrtip',
                   buttons: [{
                           extend: 'pdfHtml5',
                           orientation: 'potrait',
                           footer: true,
                       },
                       {
                           extend: 'excelHtml5',
                           footer: true,
                       }
                   ],
                   columns: [
                       {
                           data: 'created_at',
                           name: 'created_at'
                       },
                       {
                           data: 'kode_transaksi',
                           name: 'kode_transaksi'
                       },
                       {
                           data: 'user.name',
                           name: 'user.name'
                       },
                       {
                           data: 'paket_travel',
                           name: 'paket_travel'
                       },
                       {
                           data: 'peserta',
                           name: 'peserta'
                       },
                       {
                           data: 'status',
                           name: 'status'
                       },
                       {
                           data: 'total_harga',
                           name: 'total_harga',
                           render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                       },
                       {
                           data: 'action',
                           name: 'action',
                           orderable: false,
                           searcable: false,
                           width: '10%',
                       }
                   ],
                   "footerCallback": function(row, data) {
                       var api = this.api(),
                           data;
                       var intVal = function(i) {
                           return typeof i === 'string' ?
                               i.replace(/[\$,]/g, '') * 1 :
                               typeof i === 'number' ?
                               i : 0;
                       };
                      for (let i = 6; i <= 6; i++) {
                        total = api
                           .column(i)
                           .data()
                           .reduce(function(a, b) {
                               return intVal(a) + intVal(b);
                           }, 0);
                        // Total over this page
                        price = api
                            .column(i, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        $(api.column(i).footer()).html(
                            'Rp' + price
                        );
                        var numFormat = $.fn.dataTable.render.number('\,', 'Rp').display;
                        $(api.column(i).footer()).html(
                            'Rp ' + numFormat(price)
                        );
                      }
                   }
               });
           }
       });
   </script>
@endpush
