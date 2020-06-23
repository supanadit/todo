@extends('layout.admin')

@section('title')
    Welcome
@endsection

@section('subtitle')
    Do you have any task today ?
@endsection

@section('top-button')
    <button class="btn btn-info btn-sm">
        Create Directory
    </button>
@endsection

@section('content')
    <input type="text" class="form-control" placeholder="Search"/>
    <br/>
    <!-- /.box -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Bookmarks</span>
                    <span class="info-box-number">410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@endsection
