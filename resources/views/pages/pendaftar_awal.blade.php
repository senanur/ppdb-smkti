@extends('layouts.master')
@section('bootstrap-toogle')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Pendaftar Awal
                {{-- <small>Control panel</small> --}}
            </h1>
            <ol class="breadcrumb">
                <a href="{{ route('exportExcel') }}" class="btn btn-success btn-sm" title="Export Excel"><i
                        class="fa fa-file-excel-o"></i> Export Excel</a>
                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importModal"
                    title="Export Excel"><i class="fa fa-file-excel-o"></i> Import Excel</a>
            </ol>

            <!-- Import Excel Modal -->
            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Data Dari Excel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">
                                Lihat Berdasarkan Tanggal
                            </h4>
                            <div class="box-body">
                                <form action="{{ route('searchDate') }}" method="GET">
                                    @csrf
                                    <div class="form-group col-md-6">

                                        <label>Tanggal Awal Gelombang</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" name="from" class="form-control pull-right">
                                        </div>
                                        <!-- /.input group -->

                                    </div>
                                    <div class="form-group col-md-6">

                                        <label>Tanggal Akhir Gelombang</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" name="to" class="form-control pull-right">
                                        </div>
                                        <!-- /.input group -->

                                    </div>
                                    <div class="input-group-btn">
                                        <input type="submit" value="Lihat Data" class="btn btn-sm btn-success">
                                        <a href="{{ route('index.pendaftar') }}" class="btn btn-default btn-sm"
                                            type="button" title="Refresh page">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Daftar Pendaftar</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                                    <form action="" method="GET">
                                        @csrf
                                        <input type="search" name="search" class="form-control pull-right"
                                            placeholder="Cari Nama (Tekan Enter Setelah Mengetikan Nama)">
                                    </form>

                                    <div class="input-group-btn">
                                        <a href="{{ route('index.pendaftar') }}" class="btn btn-default" type="button"
                                            title="Refresh page">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No
                                            <br>
                                            Urut
                                        </th>
                                        <th>
                                            Tanggal <br>
                                            Daftar
                                        </th>
                                        <th>Nama <br>
                                            Siswa
                                        </th>
                                        <th>
                                            Gelombang <br>
                                            Pendaftar
                                        </th>
                                        <th>
                                            Status <br>
                                            <span>Daftar Ulang</span>
                                        </th>
                                        <th>
                                            Status <br>
                                            <span>Follow Up</span>
                                        </th>
                                        <th>
                                            Pilihan <br>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $gelombang = [
                                            'Gelombang Khusus' => ['2023-12-01', '2024-01-31'],
                                            'Gelombang Pertama' => ['2024-02-01', '2024-03-31'],
                                            'Gelombang Kedua' => ['2024-04-01', '2024-05-31'],
                                            'Gelombang Ketiga' => ['2024-06-01', '2024-07-31'],
                                        ];
                                    @endphp

                                    @foreach ($pendaftar as $index => $row)
                                        <tr>
                                            <td>{{ $index + $pendaftar->firstItem() }}</td>
                                            <td>{{ date('d-M-Y', strtotime($row->reg_date)) }}</td>
                                            <td>{{ $row->nm_student }}</td>
                                            <td>
                                                @foreach ($gelombang as $label => $dates)
                                                    @if (strtotime($row->created_at) >= strtotime($dates[0]) &&
                                                            strtotime($row->created_at) <= strtotime($dates[1] . ' 23:59:59'))
                                                        <span class="label label-info">{{ $label }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <input data-id="{{ $row->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Sudah" data-off="Belum" {{ $row->status ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <input data-id="{{ $row->id }}" class="toggle-class-1"
                                                    type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                    data-toggle="toggle" data-on="Sudah" data-off="Belum"
                                                    {{ $row->stts_followup ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <button type="button" value="{{ $row->id }}"
                                                    class="edit_data btn btn-primary btn-sm" data-toggle="tooltip"
                                                    data-placement="bottom" title="Lihat Detail">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                @if ($row->reg_id === null)
                                                    <a href="{{ route('generateID', $row->id) }}"
                                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        data-placement="bottom" title="Generate Reg.ID">
                                                        <i class="fa fa-barcode"></i>
                                                    </a>
                                                @else
                                                @endif
                                                <a href="#" class="btn btn-danger btn-sm delete delete-btn"
                                                    data-id="{{ $row->id }}" data-toggle="tooltip"
                                                    data-placement="bottom" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div
                                style="display: block;
                            padding-left: 5%;
                            margin-left: auto;
                            margin-right: auto;
                            width: 100%;">
                                {{ $pendaftar->links('partials.pagination') }}
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Pendaftar</h3>
                        </div>

                        <!-- form start -->
                        <form action="{{ route('store.pendaftar') }}" method="POST">
                            @csrf
                            <div class="box-body">

                                <div id="success_message" role="alert"></div>

                                <input type="hidden" name="reg_date" value="<?php echo date('Y-m-d'); ?>">

                                <div class="form-group col-md-6">
                                    <label>Nama Siswa</label>
                                    <span class="text-danger">
                                        @error('nm_student')
                                            ( {{ $message }} )
                                        @enderror
                                    </span>
                                    <input type="text" class="form-control" name="nm_student" id="nameInput"
                                        placeholder="Isi Nama Lengkap Siswa" value="{{ old('nm_student') }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="sekolahInput">Asal Sekolah</label>
                                    <span class="text-danger">
                                        @error('sch_student')
                                            ( {{ $message }} )
                                        @enderror
                                    </span>
                                    <input type="text" class="form-control" name="sch_student" id="sekolahInput"
                                        placeholder="Isikan Asal Sekolah Siswa (SMP/MTs)"
                                        value="{{ old('sch_student') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="noInput">No. HP Siswa</label>
                                    <span class="text-danger">
                                        @error('phn_student')
                                            ( {{ $message }} )
                                        @enderror
                                    </span>
                                    <input type="text" class="form-control" name="phn_student" id="noInput"
                                        placeholder="Isikan No. HP Siswa" value="{{ old('phn_student') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="noInputParent">No. HP Orang Tua/Wali</label>
                                    <span class="text-danger">
                                        @error('phn_parent')
                                            ( {{ $message }} )
                                        @enderror
                                    </span>
                                    <input type="text" class="form-control" name="phn_parent" id="noInputParent"
                                        placeholder="Isikan No. HP Orang Tua / Wali" value="{{ old('phn_parent') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="alamatInput">Alamat</label>
                                    <span class="text-danger">
                                        @error('addrs_student')
                                            ( {{ $message }} )
                                        @enderror
                                    </span>
                                    <textarea class="form-control" rows="3" id="alamatInput" name="addrs_student"
                                        placeholder="Isikan Alamat Siswa">{{ old('addrs_student') }}</textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Pilih Jurusan Pertama</label>
                                    <span class="text-danger">
                                        @error('mjr_student_ft')
                                            ( {{ $message }} )
                                        @enderror
                                    </span>
                                    <select class="form-control" name="mjr_student_ft">
                                        <option value="" selected>--- Pilih Jurusan ---</option>
                                        <option value="DKV">DKV | Desain Komunikasi Visual</option>
                                        <option value="Broadcasting">BDP | Brodcasting & Perfilman</option>
                                        <option value="TJKT">TJKT | Teknik Jaringan Komputer Telekomunikasi</option>
                                        <option value="Pemasaran">PPLG | Perancangan Perangkat Lunak & Gim</option>
                                        <option value="MPLB">MPLB | Manajamen Perkantoran Lembaga Bisnis </option>
                                        <option value="Pemasaran">DM | Digital Marketing</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Pilih Jurusan Kedua</label>
                                    <span class="text-danger">
                                        @error('mjr_student_snd')
                                            ( {{ $message }} )
                                        @enderror
                                    </span>
                                    <select class="form-control" name="mjr_student_snd">
                                        <option value="" selected>--- Pilih Jurusan ---</option>
                                        <option value="DKV">DKV | Desain Komunikasi Visual</option>
                                        <option value="Broadcasting">BDP | Brodcasting & Perfilman</option>
                                        <option value="TJKT">TJKT | Teknik Jaringan Komputer Teknologi</option>
                                        <option value="Pemasaran">PPLG | Perancangan Perangkat Lunak & Gim</option>
                                        <option value="MPLB">MPLB | Manajamen Perkantoran Lembaga Bisnis </option>
                                        <option value="Pemasaran">DM | Digital Marketing</option>
                                    </select>
                                </div>
                                <input type="hidden" name="reg_id">
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </section>
        <!-- /.content -->

        {{-- Show Modal --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pendaftar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- Id Data --}}
                        <input type="hidden" id="edit_id">
                        <div class="form-group col-md-12">
                            <label>Nomor Registrasi</label>
                            <input type="text" id="edit_noreg" class="name form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Asal Sekolah</label>
                            <input type="text" id="edit_sch" class="name form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Jurusan</label>
                            <input type="text" id="edit_j1" class="name form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No. HP Siswa</label>
                            <input type="text" id="edit_no1" class="name form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No. HP Orang Tua/Wali</label>
                            <input type="text" id="edit_no2" class="name form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Alamat</label>
                            <textarea name="" id="edit_add" cols="2" rows="5" class="form-control" disabled></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    {{-- Show data Script --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit_data', function(e) {
                e.preventDefault();
                var pendaftar_id = $(this).attr('value');
                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/manajemen/daftar-awal/edit/" + pendaftar_id,
                    success: function(response) {
                        console.log(response)
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass("alert alert-danger");
                            $('#success_message').text(response.message);
                        } else {
                            $('#edit_id').val(pendaftar_id);
                            $('#edit_noreg').val(response.pendaftar.reg_id);
                            $('#reg_date').val(response.pendaftar.reg_date);
                            $('#edit_nm').val(response.pendaftar.nm_student);
                            $('#edit_sch').val(response.pendaftar.sch_student);
                            $('#edit_j1').val(response.pendaftar.mjr_student_ft);
                            $('#edit_j2').val(response.pendaftar.mjr_student_snd);
                            $('#edit_no1').val(response.pendaftar.phn_student);
                            $('#edit_no2').val(response.pendaftar.phn_parent);
                            $('#edit_add').val(response.pendaftar.addrs_student);
                        }
                    }
                });
            });
        });
    </script>
    {{-- Swal Script --}}
    <script>
        $('.delete-btn').click(function() {
            var pendaftar_id = $(this).attr('data-id');
            swal({
                    title: "Konfirmasi Penghapusan",
                    text: "Apakah anda ingin menghapus data?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/manajemen/daftar-awal/" + pendaftar_id + ""
                    } else {
                        swal("Proses Penghapusan Dibatalkan");
                    }
                });
        });
    </script>
    {{-- Toastr Script --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
    {{-- Toggle Change Status Daftar Ulang Script --}}
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('changeStatus') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            });
        });
    </script>
    {{-- Toggle Change Status Follow Up Script --}}
    <script>
        $(function() {
            $('.toggle-class-1').change(function() {
                var stts_followup = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('followUp') }}",
                    data: {
                        'stts_followup': stts_followup,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            });
        });
    </script>

    {{-- Toggle Change Status Button Script --}}
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('changeStatus') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            });
        });
    </script>
@endsection
