@extends('Zoolflat::admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('zoolflat::zoolflat.Zoolflat Export')
            <small>
                @lang('zoolflat::zoolflat.Here you Can Export Any module you generated with Zoolflat')
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('zoolflat::zoolflat.Home')</a></li>
            <li><a class="active">@lang('zoolflat::zoolflat.Zoolflat Export')</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="callout callout-info">
            <h4>@lang('zoolflat::zoolflat.Zoolflat Export')!</h4>
            <p>@lang('zoolflat::zoolflat.Here you Can Export Any module you generated with Zoolflat')</p>
        </div>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('zoolflat::zoolflat.Zoolflat Export')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            {!! Form::open(['route' => 'post-export', 'role' => 'form']) !!}
                <div class="box-body">
                    @include('Zoolflat::fileds.php.select' , ['name' => 'module' , 'label' => trans('zoolflat::zoolflat.Zoolflat Export') ,'array' => $modules   ])
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