@extends('layout.admin')

@section('title')
    Welcome
@endsection

@section('subtitle')
    Do you have any task today ?
@endsection

@section('top-button')
    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#todo-create-modal">
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

    <div class="row" id="todo-list">
        <div style="text-align: center;height: 200px;position: relative;">
            <i class="fa fa-spinner fa-spin" style="position: absolute;top:50%;left:50%;"></i>
        </div>
    </div>

    <div class="modal fade" id="todo-create-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/" method="post" id="todo-create-modal-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Create Todo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Insert todo name or title"
                                   id="todo-create-field-name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control"
                                      id="todo-create-field-description"
                                      rows="3"
                                      style="resize:vertical;max-height: 200px;min-height:100px;"
                                      placeholder="Describe what this todo really is"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-spinner fa-spin" id="todo-create-modal-save-loading-indicator"></i>
                            <span id="todo-create-modal-save-button-label">Save</span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="todo-view-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="todo-view-modal-title"></h4>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>Description</dt>
                        <dd id="todo-view-modal-description"></dd>
                    </dl>
                    <div>
                        <b>Todo Item List</b>
                        <div class="pull-right">
                            <button class="btn btn-info btn-xs" id="todo-view-modal-add-todo-item-button">
                                Add Todo Item
                            </button>
                        </div>
                    </div>
                    <table class="table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th style="width: 90px;">Action</th>
                        </tr>
                        </thead>
                        <tbody id="todo-view-modal-table-body"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Edit Todo</button>
                    <button type="button" class="btn btn-danger">Delete Todo</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="todo-item-create-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/" method="post" id="todo-item-create-modal-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Create Todo Item</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control"
                                   placeholder="Insert todo item name here"
                                   id="todo-item-create-modal-field-name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left"
                                id="todo-item-create-modal-cancel-button">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-spinner fa-spin" id="todo-item-create-modal-save-loading-indicator"></i>
                            <span id="todo-item-create-modal-save-button">Save</span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')
    <script type="application/javascript">
        let todoId = null;

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
                $("#todo-create-modal").modal('show');
                return false;
            }
        });

        const loadTodoList = function () {
            $.ajax({
                type: "GET",
                url: "/web/todo",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    "search": $("#search-todo").val(),
                },
                contentType: "application/json",
                async: true,
                success: function (result) {
                    if (result.length !== 0) {
                        $("#todo-list").html(result.map(m => todoComponent(m)));
                    } else {
                        $("#todo-list").html("<div style=\"text-align: center;height: 200px;position: relative;\">\n" +
                            "            <p style=\"position: absolute;top:50%;left:50%;color:#777;\"><i class='fa fa-calendar-times-o'></i>&nbsp;Not found or empty</p>\n" +
                            "        </div>");
                    }
                },
                error: function (result) {
                    toastr.error(result.responseJSON.message);
                }
            });
        }

        const todoComponent = function (todo) {
            const description = (todo.description != null ? (todo.description.length > 20) ? todo.description.substring(0, 20).concat("...") : todo.description : "");
            const todoData = "<div class=\"col-md-4 col-sm-6 col-xs-12\">\n" +
                "            <div class=\"box box-widget widget-user\">\n" +
                "                <!-- Add the bg color to the header using any of the bg-* classes -->\n" +
                "                <div class=\"widget-user-header bg-aqua-active\">\n" +
                "                    <h3 class=\"widget-user-username\">" + todo.name + "</h3>\n" +
                "                    <h5 class=\"widget-user-desc\">" + description + "</h5>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>";
            return $(todoData).click(function () {
                todoId = todo.id;

                loadTodoItemList();

                $("#todo-view-modal-title").html(todo.name);
                $("#todo-view-modal-description").html(todo.description);

                $("#todo-view-modal").modal('show');
            });
        }

        const todoItemTableRowComponent = function (todoItem) {
            const buttonToggleMark = "<button type=\"button\" class=\"btn btn-xs " + (!todoItem.complete ? "btn-danger" : "btn-success") + "\"><i class=\"fa " + (!todoItem.complete ? "fa-toggle-off" : "fa-toggle-on") + "\"></i></button>";
            const buttonEdit = "<button class=\"btn btn-xs btn-info\"><i class=\"fa fa-edit\"></i></button>";
            return "<tr>\n" +
                "                            <td>" + todoItem.name + "</td>\n" +
                "                            <td><label class=\"label " + (!todoItem.complete ? "label-danger" : "label-success") + "\">" + (!todoItem.complete ? "Not complete" : "Complete") + "</label></td>\n" +
                "                            <td>\n" +
                "                                " + buttonToggleMark + "\n" +
                "                                " + buttonEdit + "\n" +
                "                                <button class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"></i></button>\n" +
                "                            </td>\n" +
                "                        </tr>";
        }

        const loadTodoItemList = function () {
            $("#todo-view-modal-table-body").html("<tr>\n" +
                "                            <td colspan=\"4\" style=\"text-align:center;color:#777;\">\n" +
                "                                <i class=\"fa fa-spinner fa-spin\"></i>\n" +
                "                            </td>\n" +
                "                        </tr>");
            $.ajax({
                type: "GET",
                url: "/web/todo/item/" + todoId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                contentType: "application/json",
                async: true,
                success: function (result) {
                    if (result.length !== 0) {
                        $("#todo-view-modal-table-body").html(result.map(m => todoItemTableRowComponent(m)));
                    } else {
                        $("#todo-view-modal-table-body").html("<tr>\n" +
                            "                            <td colspan=\"4\" style=\"text-align:center;color:#777;\">\n" +
                            "                                No Todo Item\n" +
                            "                            </td>\n" +
                            "                        </tr>");
                    }
                },
                error: function (result) {
                    toastr.error(result.responseJSON.message);
                }
            });
        }

        $(document).ready(function () {
            // Prepare Data From Backend
            loadTodoList();

            // Component Initialization
            $("#todo-create-modal-save-loading-indicator").hide();
            $("#todo-item-create-modal-save-loading-indicator").hide();

            // Create Todo Submit Action
            $("#todo-create-modal-form").on("submit", function (e) {
                e.preventDefault();

                const name = $("#todo-create-field-name");
                const description = $("#todo-create-field-description");

                $.ajax({
                    type: "POST",
                    url: "/web/todo",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: JSON.stringify({
                        "name": name.val(),
                        "description": description.val(),
                    }),
                    contentType: "application/json",
                    dataType: "json",
                    async: true,
                    beforeSend: function () {
                        $("#todo-create-modal-save-loading-indicator").show();
                        $("#todo-create-modal-save-button-label").hide();
                    },
                    success: function (result) {
                        $("#todo-create-modal-save-loading-indicator").hide();
                        $("#todo-create-modal-save-button-label").show();

                        name.val(null);
                        description.val(null);

                        toastr.success(result.message);

                        $("#todo-create-modal").modal('hide');

                        loadTodoList();
                    },
                    error: function (result) {
                        $("#todo-create-modal-save-loading-indicator").hide();
                        $("#todo-create-modal-save-button-label").show();

                        toastr.error(result.responseJSON.message);
                    }
                });
            });

            // Create Todo Item Submit Action
            $("#todo-item-create-modal-form").on("submit", function (e) {
                e.preventDefault();

                const name = $("#todo-item-create-modal-field-name");

                $.ajax({
                    type: "POST",
                    url: "/web/todo/item",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: JSON.stringify({
                        "name": name.val(),
                        "todo_id": todoId,
                    }),
                    contentType: "application/json",
                    dataType: "json",
                    async: true,
                    beforeSend: function () {
                        $("#todo-item-create-modal-save-loading-indicator").show();
                        $("#todo-item-create-modal-save-button-label").hide();
                    },
                    success: function (result) {
                        $("#todo-item-create-modal-save-loading-indicator").hide();
                        $("#todo-item-create-modal-save-button-label").show();

                        name.val(null);

                        toastr.success(result.message);

                        $("#todo-view-modal").modal('show');
                        $("#todo-item-create-modal").modal('hide');

                        loadTodoItemList();
                    },
                    error: function (result) {
                        $("#todo-item-create-modal-save-loading-indicator").hide();
                        $("#todo-item-create-modal-save-button-label").show();

                        toastr.error(result.responseJSON.message);
                    }
                });
            });

            // Search
            $("input#search-todo").on('keyup', function () {
                loadTodoList();
            });

            // Button Add Todo Item
            $("#todo-view-modal-add-todo-item-button").click(function () {
                $("#todo-view-modal").modal('hide');
                $("#todo-item-create-modal").modal('show');
            });

            // Button Cancel On Create Todo Item Modal
            $("#todo-item-create-modal-cancel-button").click(function () {
                $("#todo-view-modal").modal('show');
                $("#todo-item-create-modal").modal('hide');
            });
        });
    </script>
@endsection
