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
                        @if($timers->count() != 0)
                            @foreach($timers as $k => $timer)
                                <div class="col-md-12">
                                    <span>{{ $timer->group->name }}</span>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <timer-progress name="{{ $timer->job->id }}" start="{{ $timer->job->created_at->timestamp }}" end="{{ $timer->job->available_at }}"></timer-progress>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('timers.destroy', $timer) }}" class="btn btn-round btn-outline-danger" dusk="timer-delete-{{ $timer->id }}" data-method="delete" data-confirm="Are you sure you want to reset timer about {{ $timer->group->name }} ?"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                    @if($timers->count() != $k  + 1)
                                        <hr>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                No timer is running at the moment.
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
            let api_token = $('meta[name=api-token]').attr('content')
            let timer_form = $("#timer-form")
            timer_form.submit(function (e) {
                e.preventDefault();
                let group = $("#group").val()
                let state = $("#state").val()
                let period = $("#period").val()
                let text = state ? "On" : "Off"
                let uri = `/api/v1/groups/${group}/state/${state}/${period}?api_token=${api_token}`;
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
                        document.location.reload(true);
                    });
                }

            });
        });
    </script>
@endsection
