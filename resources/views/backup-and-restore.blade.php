
@extends('layouts.admin')

@section('content')


                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Backup and Restore</h1>

                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)

                            <li>{{$error}}</li>

                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(\Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> </h5>
                      {{ \Session::get('success') }}
                    </div>
                    @endif

                    @if(\Session::has('danger'))
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> </h5>
                      {{ \Session::get('danger') }}
                    </div>
                    @endif
                    <div class="row mb-2">

                    <div class="col-sm-2 col-md-2 col-lg-10 mb-3">

                         <a  href="/download/" class="btn btn-primary btn-sm" >Backup</a>
                        <a href ="https://auth-db607.hostinger.com/" target="_blank" class="btn btn-success btn-sm" >Restore</a>

                        </div>
                    </div>
            <!-- End of Main Content -->
            @endsection
