<?php
use App\MyClass\Format;
?>

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">SOA Master Data</h4>
                    <p class="card-category">SOA Master Data Tabular View</p>
                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form>
                                <div class="row">
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label>Date From</label>
                                            {!! Form::date('dateFrom', \Carbon\Carbon::now(), ['class' => 'form-control -form']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label>Date To</label>
                                            {!! Form::date('dateTo', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <br>
                                            {!! Form::submit('Filter', ['class' => 'btn btn-info btn-fill btn-sm']) !!}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table table-responsive">
                                <table id="dataTbl" class="table table-hover table-striped">
                                    <thead>
                                        <th></th>
                                        <th>Customer Code</th>
                                        <th>Customer Name</th>
                                        <th>Cutoff Date</th>
                                        <th>Classification</th>
                                    </thead>
                                    <tbody>
                                    @foreach($soa_headers as $soa_header)
                                        <tr>
                                            <td class="td-actions">
                                                {!! Form::open(['url' => '/soa', 'method' => 'POST', 'target' => '_blank']) !!}
                                                    {{ Form::hidden("soa_id", $soa_header->id) }}
                                                    {{ Form::submit('View PDF', ['class' => 'btn btn-info btn-fill btn-sm', 'style' => 'cursor:pointer']) }}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>{{ $soa_header->customer_code }}</td>
                                            <td>{{ $soa_header->customer_name }}</td>
                                            <td>{{ $soa_header->cutoff_date }}</td>
                                            <td>{{ $soa_header->classification }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
