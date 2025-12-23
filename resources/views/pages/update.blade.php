@extends('layouts.master')

@section('content')
    <!-- Main content -->

    <div class="content-wrapper">
        <section class="content">
    
            <div class="row">
                <div class="col-xs-12">
       
                    <div class="pad margin no-print">
                        <div class="callout callout-info" style="margin-bottom: 0!important;">
                          <h4><i class="fa fa-info"></i> PERHATIAN</h4>
                            Pastikan Siswa Telah Melakukan Pembayaran Pendaftaran Awal
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Generate ID Pendaftar</h3>
                        </div>
                       
                        <!-- form start -->
                        <form action="{{ route('updateID',$pendaftar_data->id) }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <strong><i class="fa fa-user margin-r-5"></i> Nama Siswa</strong>
                  
                                <p>{{$pendaftar_data->nm_student}}</p>

                                <hr>

                                <strong><i class="fa fa-book margin-r-5"></i>Asal Sekolah</strong>
                  
                                <p class="text-muted">
                                  {{$pendaftar_data->sch_student}}
                                </p>
                  
                                <hr>
                  
                                <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat Rumah</strong>
                  
                                <p class="text-muted">{{$pendaftar_data->addrs_student}}</p>
                  
                                <hr>
                  
                                <strong><i class="fa fa-pencil margin-r-5"></i> Pilihan Jurusan</strong>
                  
                                <p>
                                    <span>Jurusan Pertama :</span>
                                    <span class="label label-success">{{$pendaftar_data->mjr_student_ft}}</span>
                                    <br> <br>
                                    <span>Jurusan Kedua :</span>
                                    <span class="label label-info">{{$pendaftar_data->mjr_student_snd}}</span>
                                </p>
                  
                                <hr>
                              </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
                    
        </section>

    </div>

    
    <!-- /.content -->
@endsection