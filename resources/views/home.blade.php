<?php
use App\MyClass\Format;
?>

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title ">Statement Of Account &nbsp; </h4>
                    <p class="card-category">Last Upload As Of {{ Format::toLongDate($latestSoa->cutoff_date) }}</p>
                </div>

                <div class="card-body all-icons table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <div class="legend">
                                    <br>
                                    <i class="fa fa-circle text-success"></i>&nbsp; {{ $latestSoa->classification }}
                                </div>
                            </td>
                            <td>
                                <span class="small text-muted">Total Amount Due:</span> <br>
                                <b>{{ $latestSoaAmount->total_amount_due }}</b>
                            </td>
                            <td>
                                <span class="small text-muted">Total Amount Past Due:</span> <br>
                                <b>{{ $latestSoaAmount->total_amount_past_due }}</b>
                            </td>
                            <td class="td-actions text-right">
                                {!! Form::open(['url' => '/soa', 'method' => 'POST', 'target' => '_blank']) !!}
                                {{ Form::hidden("soa_id", "$latestSoa->soa_id") }}
                                {{ Form::submit('View PDF', ['class' => 'btn btn-info btn-fill pull-right']) }}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-clock-o"></i>Sent {{ $sendMessage }}
                    </div>
                </div>
            </div>
        </div>

        {{-- ACCOUNT INFO --}}

        <div class="col-md-4">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title">Account Info</h4>
                    <p class="card-category">Updated As Of {{ Format::toLongDateTime(Auth::user()->updated_at) }}</p>
                </div>

                <div class="card-body all-icons" style="overflow: hidden;">
                    <i class="nc-icon nc-single-02"></i>&nbsp;{{ Auth::user()->name }}<br>
                    <i class="nc-icon nc-email-83"></i>&nbsp;{{ Auth::user()->email }}<br>
                    <i class="nc-icon nc-bank"></i>&nbsp;{{ Auth::user()->customers()->first()->address }}
                </div>

                <div class="card-footer ">

                </div>
            </div>
        </div>
    </div>


    {{-- RECENT UPLOADS --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title ">Recent Uploads  </h4>
                    <p class="card-category">Last Upload As Of {{ Format::toLongDate($latestSoa->cutoff_date) }}</p>
                </div>

                <div class="card-body all-icons table-responsive">
                    <table class="table small table-hover" style="white-space: nowrap;">
                        <thead>
                            <th></th>
                            <th>Date</th>
                            <th></th>
                        </thead>
                        <tbody>

                        <?php $i = 1; ?>
                        @foreach($soaHeaders as $soaHeader)
                        <tr>
                            <td>
                                <i class="fa fa-wpforms"></i>&nbsp;{{ $soaHeader->classification }} &nbsp; @if($i == 1) <span class="badge badge-pill badge-danger">Latest</span>@endif
                            </td>
                            <td>
                                {{ $soaHeader->cutoff_date }}
                            </td>
                            <td class="td-actions">
                                {!! Form::open(['url' => '/soa', 'method' => 'POST', 'target' => '_blank']) !!}
                                    {{ Form::hidden("soa_id", "$soaHeader->soa_id") }}
                                    {{ Form::submit('View PDF', ['class' => 'btn btn-info btn-fill pull-right']) }}
                                {!! Form::close() !!}
                            </td>
                        </tr>

                        @if($i == 5)
                            @break
                        @endif
                        <?php $i++; ?>
                        @endforeach

                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>

@endsection
