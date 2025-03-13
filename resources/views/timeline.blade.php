@extends('layout.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/frappe-gantt/dist/frappe-gantt.css">
@endsection


@section('title')
    Timeline View
@endsection

@section('subtitle')
    Your todo in a timeline view
@endsection


@section('css')
    <style>
        .widget-user {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <br/>
    <div id="gantt"></div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/frappe-gantt/dist/frappe-gantt.umd.js"></script>
    <script type="application/javascript">
        let tasks = [
            {
                id: '1',
                name: 'Redesign website',
                start: '2025-02-28',
                end: '2025-03-16',
                progress: 20
            },
            {
                id: '2',
                name: 'Redesign website',
                start: '2025-03-03',
                end: '2025-03-04',
                progress: 20,
                dependencies: '1'
            }
        ];
        let gantt = new Gantt("#gantt", tasks, {
            bar_height: 16,
            column_width: 30,
            container_height: 670,
            view_mode_select: true,
            readonly: true,
        });
    </script>
@endsection
