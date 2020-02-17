@extends("layouts.app")

@section('title', "Home")

@section('content')
    <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
    </div>

    <div class="content">
        <div class="row d-none">
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Global Sales</h5>
                        <h4 class="card-title">Shipped Products</h4>
                        <div class="dropdown">
                            <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                <i class="now-ui-icons loader_gear"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <a class="dropdown-item text-danger" href="#">Remove Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="lineChartExample"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">2018 Sales</h5>
                        <h4 class="card-title">All products</h4>
                        <div class="dropdown">
                            <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                                <i class="now-ui-icons loader_gear"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <a class="dropdown-item text-danger" href="#">Remove Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Email Statistics</h5>
                        <h4 class="card-title">24 Hours Performance</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="barChartSimpleGradientsNumbers"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card  card-tasks">
                    <div class="card-header ">
                        <h4 class="card-title">Cooldown</h4>
                    </div>
                    <div class="card-body">
                        @if($lastJob)
                            <div id="timer" class="circle-progress" data-animation-start-value="" data-start="{{ $lastJob->created_at->timestamp }}" data-end="{{ $lastJob->available_at }}">
                                <strong></strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Start Timer</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" id="timer-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group">Groups</label>
                                        <select name="group" id="group" class="form-control">
                                            @foreach(\App\Group::all() as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select name="state" id="state" class="form-control">
                                            <option value="0">Off</option>
                                            <option value="1">On</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="period">Period (Minutes)</label>
                                <input type="number" class="form-control" id="period" name="period">
                            </div>

                            <button type="submit" class="btn btn-round btn-success" id="timer-form-button">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="application/javascript">
        $(document).ready(function() {
            let timer = $("#timer")

            if (timer.length) {
                let start = new Date(timer.data("start") * 1000)
                let end = new Date(timer.data("end") * 1000)
                let percent = Math.round((100 - (end -  new Date()) / (end - start) * 100));

                timer.attr("data-animation-start-value", 1 - (percent /100))

                let timerBar = timer.circleProgress({
                    value: 1 - (percent /100),
                    fill: {gradient: ['#0681c4', '#4ac5f8']},
                    size: 200
                }).on('circle-animation-progress', function(event, progress, stepValue) {
                    let diff = end.getTime() - new Date().getTime()
                    let minutes= Math.round((diff % 3600000 ) / 60000);
                    let secondes= Math.round((diff % 60000) / 1000);

                    if (secondes >= 30)
                        minutes--;

                    let minutesText = minutes <= 0 ? '00' : ('0' + minutes).slice(-2)
                    let secondesText = secondes <= 0 ? '00' : ('0' + secondes).slice(-2)
                    $(this).find('strong').text( minutesText + ":" + secondesText);
                    // $(this).find('strong').text(100 - percent);
                });

                let update = setInterval(function(){

                    let diff = end.getTime() - new Date().getTime()
                    let minutes= Math.round((diff % 3600000 ) / 60000);
                    let secondes= Math.round((diff % 60000) / 1000);

                    percent = Math.round((100 - (end - new Date()) / (end - start) * 100));
                    if (percent >= 100) {
                        percent = 100;
                        clearInterval(update)
                    }
                    timerBar.circleProgress('value', 1 - (percent /100));
                }, 500);
            }

            let timer_form = $("#timer-form")

            timer_form.submit(function (e) {
                e.preventDefault();
                let group = $("#group").val()
                let state = $("#state").val()
                let period = $("#period").val()
                let text = state ? "On" : "Off"
                let uri = "/api/v1/group/" + group + "/state/" + state + "/" + period;
                if (period.length) {
                    $.get(uri).done(function( data ) {
                        new Noty({
                            type: 'success',
                            theme: 'mint',
                            layout: 'topRight',
                            text: "Light " + text + " for " + period + " minutes",
                            closeWith: ['click', 'button'],
                            timeout: 3000
                        }).show();
                    });
                }

            });
        });
    </script>
@endsection
