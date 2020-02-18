@extends("layouts.app")

@section('title', "Home")

@section('content')
    <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card  card-tasks">
                    <div class="card-header ">
                        <h4 class="card-title">Cooldown</h4>
                    </div>
                    <div class="card-body">
                        @if($lastJob)
                            <div class="circle-progress timer" data-animation-start-value="" data-start="{{ $lastJob->created_at->timestamp }}" data-end="{{ $lastJob->available_at }}">
                                <strong></strong>
                            </div>
                        @else
                            <div class="circle-progress timer" data-animation-start-value="" data-start="{{ \Carbon\Carbon::now()->subSecond()->timestamp }}" data-end="{{ \Carbon\Carbon::now()->timestamp }}">
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



            /* Timer Form */
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
