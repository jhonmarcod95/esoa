@extends('layouts.app')

@section('content')
    <?php use App\MyClass\Format;?>

    @if(count($classifications))
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">

                <div class="card-body table-responsive">
                    <div class="collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li><a href="">Login</a></li>
                        <li><a href="">Register</a></li>
                    </ul>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <th></th>
                        <th>Account Classification</th>
                        <th>Statement Period</th>
                        <th><div class="text-center">Total Amount Due</div></th>
                        <th><div class="text-center">Total Amount Past Due</div></th>
                        <th></th>

                        </thead>
                        <tbody>
                        @foreach($classifications as $classification => $statements)
                            <tr>

                                <td><i class="fa fa-circle text-success"></i></td>
                                <td>{{ $classification }}</td>
                                <td>
                                    {!! Form::open(['url' => '/soa', 'method' => 'POST', 'target' => '_blank']) !!}
                                    <?php $classification = str_replace("/", "", $classification); #remove slashes to avoid error in VUE ?>
                                    <select name="soa_id" v-model="{{ "statement_period_$classification" }}" class="form-control">
                                        <option disabled value="">-- Select Date --</option>
                                        @foreach($statements as $statement)
                                            <option value="{{ $statement->soa_id }}">{{ $statement->cutoff_date }}</option>
                                        @endforeach
                                    </select>
                                    <button id="{{ $statement->classification }}" type="submit" hidden></button>
                                    {!! Form::close() !!}
                                </td>
                                <td class="text-center">{{ <?php echo "statement_amount_$classification.total_amount_due"; ?> }}</td> {{-- Total Amount Due --}}
                                <td class="text-center">{{ <?php echo "statement_amount_$classification.total_amount_past_due"; ?> }}</td> {{-- Total Amount PAST Due --}}
                                <td class="td-actions text-right"><button class="btn btn-info btn-fill" onclick="document.getElementById('{{ $statement->classification }}').click()">&nbsp;View PDF</button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-info-circle"></i>&nbsp; {{ $classifications->count() }} Records Found
                    </div>
                </div>
            </div>
        </div>

    </div>
    @else
        <span class="text-danger">No available records.</span>
    @endif

@endsection

@section('vue')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {

                @foreach($classifications as $classification => $statements)
                <?php $classification = str_replace("/", "", $classification); #remove slashes to avoid error in VUE ?>

                {{ "statement_period_$classification: " }}"",  //request
                {{ "statement_amount_$classification: " }}0, //response
                @endforeach

            },
            methods: {},
            computed: {},
            watch: {

                @foreach($classifications as $classification => $statements)
                <?php $classification = str_replace("/", "", $classification); #remove slashes to avoid error in VUE ?>

                {{ "statement_period_$classification" }}:

                function (val) {
                    axios.get('{{ url('/soa/compute') }}/' + val).then(
                        response => {{ "this.statement_amount_$classification" }} = response.data
                    );
                }
                ,
                @endforeach

            },
        })
        ;
    </script>
@endsection
