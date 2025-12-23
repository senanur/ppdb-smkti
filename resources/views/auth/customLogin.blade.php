<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo_smktia.png')}}">
    <title>Login Profil Daftar Ulang</title>

    {{-- CDN Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container"> 
        <div class="row">
            <div class="col-md-4 mx-auto my-5">
                <div class="card text-white bg-success">
                    <div class="card-header text-center">
                        <img src="{{ asset('assets/images/logo_smktia.png')}}" alt="SMKS TI Airlangga"
                        style="display: inline-block;
                        margin-left: auto;
                        margin-right: auto;
                        width: 10%;">
                        LOGIN DAFTAR ULANG
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nomor Pendaftaran</label>
                            <input type="text" class="form-control" name="reg_id">
                            </div>
                            <button type="submit" class="btn btn-secondary text-white">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    {{-- CDN JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>