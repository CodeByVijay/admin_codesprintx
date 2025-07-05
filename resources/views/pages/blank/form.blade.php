@extends('layout.app')
@section('title', 'Form')
@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Form', 'url' => route('form')],
        // ['label' => 'Specific Product', 'url' => ''],
    ]" title="Blank Form" />

    <section class="content">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-md-12"> --}}

            {{-- <div class="card card-primary"> --}}
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Quick Example</h3>
                </div>

                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer float-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancle</button>
                        </div>

                    </form>
                </div>
                <!-- /.card-body -->



            </div>
            {{--
                </div>
            </div> --}}

        </div>
    </section>

@endsection
