<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMKS TI Airlangga | Pendaftaran Awal</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo_smktia.png') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/style.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <img src="{{ asset('assets/images/logo_smktia.png') }}" alt="SMKS TI Airlangga"
            style=" display: block;
    margin-left: auto;
    margin-right: auto;
    width: 40%;">
        <div class="register-logo">
            <h3><b>Aplikasi</b></h3>
            <h4><b>Pendaftaran Peserta Didik Baru</b></h4>
            <h4 id="currentYear"></h4>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Formulir Pendaftaran Awal</p>
            <form action="{{ route('siswa.pendaftar') }}" method="POST">
                @csrf

                <input type="hidden" name="reg_date" value="<?php echo date('Y-m-d'); ?>">

                <p class="text-danger">
                    @error('nm_student')
                        {{ $message }}
                    @enderror
                </p>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Nama Lengkap Anda" name="nm_student"
                        value="{{ old('nm_student') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <p class="text-danger">
                    @error('sch_student')
                        {{ $message }}
                    @enderror
                </p>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="sch_student"
                        placeholder="Asal Sekolah(SMP/MTs) Anda" value="{{ old('sch_student') }}">
                    <span class="glyphicon glyphicon-education form-control-feedback"></span>
                </div>

                <p class="text-danger">
                    @error('phn_student')
                        {{ $message }}
                    @enderror
                </p>
                <div class="form-group has-feedback">
                    <input type="text" name="phn_student" class="form-control" placeholder="No.Handphone Aktif Anda"
                        value="{{ old('phn_student') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>

                <p class="text-danger">
                    @error('phn_parent')
                        {{ $message }}
                    @enderror
                </p>
                <div class="form-group has-feedback">
                    <input type="text" name="phn_parent" class="form-control"
                        placeholder="No.Handphone Aktif Orang Tua/Wali Anda" value="{{ old('phn_parent') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>

                <p class="text-danger">
                    @error('addrs_student')
                        {{ $message }}
                    @enderror
                </p>
                <div class="form-group has-feedback">
                    <textarea name="addrs_student" class="form-control" cols="30" rows="5" placeholder="Alamat Lengkap Anda">{{ old('addrs_student') }}</textarea>
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                </div>

                <p class="text-danger">
                    @error('mjr_student_ft')
                        {{ $message }}
                    @enderror
                </p>
                <div class="form-group has-feedback">
                    <select class="form-control" name="mjr_student_ft">
                        <option value="" selected>Pilihan Jurusan</option>
                        <option value="DKV">DKV | Desain Komunikasi Visual</option>
                        <option value="Broadcasting">BDP | Brodcasting & Perfilman</option>
                        <option value="TJKT">TJKT | Teknik Jaringan Komputer Telekomunikasi</option>
                        <option value="Pemasaran">PPLG | Perancangan Perangkat Lunak & Gim</option>
                        <option value="MPLB">MPLB | Manajamen Perkantoran Lembaga Bisnis </option>
                        <option value="Pemasaran">DM | Digital Marketing</option>
                    </select>
                </div>

                {{-- <p class="text-danger">
                    @error('mjr_student_snd')
                        {{ $message }}
                    @enderror
                </p>
                <div class="form-group has-feedback">
                    <select class="form-control" name="mjr_student_snd">
                        <option value="" selected>Pilihan Jurusan Kedua</option>
                        <option value="DKV">DKV | Desain Komunikasi Visual</option>
                        <option value="Broadcasting">BDP | Brodcasting & Perfilman</option>
                        <option value="TJKT">TJKT | Teknik Jaringan Komputer Telekomunikasi</option>
                        <option value="Pemasaran">PPLG | Perancangan Perangkat Lunak & Gim</option>
                        <option value="MPLB">MPLB | Manajamen Perkantoran Lembaga Bisnis </option>
                        <option value="Pemasaran">DM | Digital Marketing</option>
                    </select>
                </div> --}}
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
                        <button type="reset" class="btn btn-primary btn-block btn-flat">Bersihkan</button>
                        <div class="checkbox icheck">
                            <label>
                                Info Lanjut : 0811-5555-214 (Call Center )
                                {{-- <input type="checkbox"> I agree to the <a href="#">terms</a> --}}
                                <p>Syarat dan Ketentuan:</p>
                                <ul>
                                    <li>Biaya Pendaftaran Rp. 100.000,-</li>
                                    <li>Pembayaran Via Virtual Account Bank BNI : 9888111420211001 an. FORMULIR PSB SMK
                                        TI AIRLANGGA 2023</li>
                                    <li>Wajib Konfirmasi pembayaran bisa melalui telp atau bukti transfer dikirim via WA
                                        : 0811 5555 214</li>
                                </ul>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 3 -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SweetAlert-->
    <script src="{{ asset('assets/dist/js/sweetalert2.all.min.js') }}"></script>

    @if ($message = Session::get('success'))
        <script type="text/javascript">
            Swal.fire({
                title: 'Berhasil',
                text: 'Data Pendaftar Telah Disimpan, Silahkan Hubungi Call Centre Untuk Konfirmasi',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        </script>
    @endif
    <script>
        function updateCurrentYear() {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();

            const yearElement = document.getElementById('currentYear');

            // You can modify the format as needed
            yearElement.innerHTML = `<b>Tahun ${currentYear}/${currentYear + 1}</b>`;
        }

        function setYearUpdateInterval() {
            // Calculate the milliseconds for a year (365 days)
            const millisecondsInYear = 365 * 24 * 60 * 60 * 1000;

            // Set the interval to update once per year
            setInterval(updateCurrentYear, millisecondsInYear);
        }

        // Call the function initially to set the current year on page load
        updateCurrentYear();

        // Call the function to set the interval for year updates
        setYearUpdateInterval();
    </script>


</body>

</html>
