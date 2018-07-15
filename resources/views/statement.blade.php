@extends('layouts.app')

@section('content')

    {{--<div class="container">--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">{{ $classification }}</div>

                <div class="panel-body">
                    <?php
                    $statement_periods = App\SoaHeader::where('customer_code', Auth::user()->customers()->first()->customer_code)
                        ->where('classification', $classification)
                        ->where('company_code', $company_code)
                        ->where('sap_server', $sap_server)
                        ->orderBy('cutoff_date', 'DESC')
                        ->pluck('cutoff_date')
                        ->unique();
                    ?>

                    <div class="row">
                        <div class="col-md-4">
                            Statement Period
                        </div>
                    </div>

                    {!! Form::open(['url' => '/soa', 'method' => 'POST']) !!}

                    <div class="form-group">
                        <select v-model="statement_period_1" class="form-control">

                            @foreach($statement_periods as $statement_period)
                                <option value="{{ $statement_period }}">{{ $statement_period }}</option>
                            @endforeach
                        </select>

                        <br>

                        <select v-model="statement_period_2" class="form-control">

                            @foreach($statement_periods as $statement_period)
                                <option value="{{ $statement_period }}">{{ $statement_period }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            Total Amount Due:
                        </div>
                        <div id="total_amount_due" class="col-md-4">@{{ statement_amount_1.total_amount_due }}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            Total Amount Past Due:
                        </div>
                        <div id="total_amount_past_due" class="col-md-4">@{{ statement_amount_1.total_amount_past_due }}
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-4">
                            Total Amount Due:
                        </div>
                        <div id="total_amount_due" class="col-md-4">@{{ statement_amount_2.total_amount_due }}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            Total Amount Past Due:
                        </div>
                        <div id="total_amount_past_due" class="col-md-4">@{{ statement_amount_2.total_amount_past_due }}
                        </div>
                    </div>


                    <div class="form-group">
                        {{ Form::submit('View PDF', ['class' => 'mt-2 btn-outline-primary btn-block btn btn-lg rounded-0']) }}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('vue')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {

                @for($i=1;$i<=2;$i++)
                {{ "statement_period_$i: null," }} //request
                {{ "statement_amount_$i: 0," }} //response
                @endfor

            },
            methods: {},
            computed: {},
            watch: {

                @for($i=1;$i<=2;$i++)
                {{ "statement_period_$i" }}: function (val) {
                    axios.get('/esoa/public/soa/compute/' + val).then(
                        response => {{ "this.statement_amount_$i" }} = response.data
                    );
                },
                @endfor

            },
        });
    </script>
@endsection


