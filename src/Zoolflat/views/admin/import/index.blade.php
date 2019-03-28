@extends('Zoolflat::admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('zoolflat::zoolflat.Zoolflat Import')
            <small>
                @lang('zoolflat::zoolflat.Here you Can Upload any module you generated with Zoolflat')
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('zoolflat::zoolflat.Home')</a></li>
            <li><a class="active"> @lang('zoolflat::zoolflat.Zoolflat Import')</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="callout callout-info">
            <h4> @lang('zoolflat::zoolflat.Zoolflat Import') !</h4>
            <p>@lang('zoolflat::zoolflat.Here you Can Upload any module you generated with Zoolflat')</p>
        </div>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('zoolflat::zoolflat.Zoolflat Import')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            {!! Form::open(['route' => 'post-import', 'role' => 'form' , 'files' => true]) !!}
                <div class="box-body">
                    @include('Zoolflat::fileds.php.file' , ['name' => 'module' , 'value' => ''])
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {!! Form::submit(trans('zoolflat::zoolflat.Save') , ['class' => 'btn btn-info']) !!}
                </div>
            {!! Form::close() !!}
        <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection