<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title') | {{ env("APP_NAME") }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body class="">
<div class="wrapper ">
    @include('layouts._sidebar')

    <div class="main-panel" id="main-panel">
        @include('layouts._navbar')
        @yield('content')
        <footer class="footer">
            <div class=" container-fluid ">
                <nav>
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://presentation.creative-tim.com">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright" id="copyright">
                    &copy; <script>
                        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                    </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                </div>
            </div>
        </footer>
    </div>
</div>

<div class="modal fade" id="networkStatus" tabindex="-1" role="dialog" aria-labelledby="networkStatusModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Network Diagnostic</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="d-table">
                    @foreach(\App\Group::all() as $group)
                        <tr id="d-group-{{ $group->id }}" data-type="group" data-id="{{ $group->id }}">
                            <td colspan="2">{{ $group->name }}</td>
                            <td><span class="badge badge-success">OK</span></td>
                        </tr>
                        @foreach($group->lights as $light)
                            <tr id="d-light-{{ $light->id }}" data-type="light" data-id="{{ $light->id }}" data-group-id="{{ $group->id }}">
                                <td></td>
                                <td>{{ $light->name }}</td>
                                <td><span class="badge badge-success">OK</span></td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-round btn-primary" id="d-button">Refresh</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>

@yield('js')

<script type="application/javascript">
    $(document).ready(function () {
        $('#d-button').click(function () {
            let btn = $(this);
            let table = $("#d-table");

            console.log("WIP")
        })
    });
</script>

<script>
    $(document).ready(function() {
        demo.initDashboardPageCharts();
    });
</script>
</body>

</html>
