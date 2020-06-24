@extends('layout.admin')

@section('title')
    Welcome
@endsection

@section('subtitle')
    Do you have any task today ?
@endsection

@section('top-button')
    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default">
        Create Todo
    </button>
@endsection

@section('css')
    <style>
        .widget-user {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <input type="text" class="form-control" placeholder="Search" id="search-todo"/>
    <br/>
    <!-- /.box -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">Alexander Pierce</h3>
                    <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('js')
    <script type="application/javascript">
        $(document).bind('keydown', function (e) {
            // CTRL + S
            if (e.ctrlKey && e.which === 83) {
                toastr.error("Prevented");
                return false;
            }

            // CTRL + F
            if (e.ctrlKey && e.which === 70) {
                $("#search-todo").focus();
                return false;
            }

            // ALT + N
            if (e.altKey && e.which === 78) {
                $("#modal-default").modal('show');
                return false;
            }
        });

        $(document).ready(function () {

        });
    </script>
@endsection
