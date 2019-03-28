@extends('Zoolflat::admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('zoolflat::zoolflat.build menu')
            <small>
                @lang('zoolflat::zoolflat.Here you Can build your menu')
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('zoolflat::zoolflat.Home')</a></li>
            <li><a class="active"> @lang('zoolflat::zoolflat.menu builder')</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="callout callout-info">
            <h4> @lang('zoolflat::zoolflat.menu controller') !</h4>
            <p> @lang('zoolflat::zoolflat.Here you Can control your menu')</p>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('zoolflat::zoolflat.add item')</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    {!! Form::open(['route' => 'itmes.store', 'role' => 'form']) !!}
                        <div class="box-body">
                            @include('Zoolflat::fileds.php.text' , ['name' => 'name_ar' , 'label' => trans('zoolflat::zoolflat.Item name Arabic')])
                            @include('Zoolflat::fileds.php.text' , ['name' => 'name_en' , 'label' => trans('zoolflat::zoolflat.Item name English')])
                            @include('Zoolflat::fileds.php.text' , ['name' => 'icon' , 'label' => trans('zoolflat::zoolflat.icon') , 'placeholder' => '<i class="fa fa-trash"></i>'])
                            @include('Zoolflat::fileds.php.text' , ['name' => 'link' , 'label' => trans('zoolflat::zoolflat.link')])
                            @include('Zoolflat::fileds.php.select' , ['name' => 'parent_id' , 'label' => trans('zoolflat::zoolflat.Parent Item') , 'array' => [ 0 => trans('zoolflat::zoolflat.No parent menu')] + $parents])
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            {!! Form::submit(trans('zoolflat::zoolflat.Save') , ['class' => 'btn btn-info']) !!}
                        </div>
                     {!! Form::close() !!}
                <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-lg-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('zoolflat::zoolflat.menu builder') {{ $menu->name }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <table class="table table-borderd table-stripped">
                        @foreach($items as $item)
                            @php $parent = $item->parent->count() > 0 ? true : false @endphp
                            <tr>
                                <td>
                                    {{ $item->{fwcl('name')} }}
                                </td>
                                <td>
                                    {!! Form::open(['route' => [ 'itmes.destroy' , $item->id], 'role' => 'form' , 'class' => 'form-inline']) !!}
                                        {{ method_field('delete') }}
                                        <button  class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                                        <span class="btn btn-success" onclick="showEdit(this)"><i class="fa fa-edit"></i></span>
                                    @if($parent)
                                        <span class="btn btn-info" onclick="showChilds(this)"><i class="fa fa-link"></i></span>
                                    @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            <tr style="display: none" class="edit">
                                <td colspan="3">
                                    {!! Form::model( $item , ['route' => ['itmes.update' , $item->id ], 'role' => 'form']) !!}
                                    {{ method_field('patch') }}
                                    <div class="box-body">
                                        @include('Zoolflat::fileds.php.text' , ['name' => 'name_ar' , 'value' => $item->name_ar , 'label' => trans('zoolflat::zoolflat.Item name Arabic')])
                                        @include('Zoolflat::fileds.php.text' , ['name' => 'name_en' , 'value' => $item->name_en , 'label' => trans('zoolflat::zoolflat.Item name English')])
                                        @include('Zoolflat::fileds.php.text' , ['name' => 'icon' , 'value' => $item->icon , 'label' => trans('zoolflat::zoolflat.icon'), 'placeholder' => '<i class="fa fa-trash"></i>'])
                                        @include('Zoolflat::fileds.php.text' , ['name' => 'link', 'value' => $item->link  , 'label' => trans('zoolflat::zoolflat.link')])
                                        @include('Zoolflat::fileds.php.select' , ['name' => 'parent_id', 'value' => $item->parent_id  ,  'label' => trans('zoolflat::zoolflat.Parent Item') , 'array' => [ 0 => trans('zoolflat::zoolflat.No parent menu')] + array_except( $parents, $item->id)])
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        {!! Form::submit(trans('zoolflat::zoolflat.Save') , ['class' => 'btn btn-info']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @if($parent)
                                <tr style="display: none" class="child">
                                <td colspan="3">
                                    <ol class="list-group">
                                        @foreach($item->parent  as $item)
                                            <li class="list-group-item">
                                                {!! Form::open(['route' => [ 'itmes.destroy' , $item->id], 'role' => 'form' , 'class' => 'inline-form']) !!}
                                                {{ $item->{fwcl('name')} }}
                                                {{ method_field('delete') }}
                                                <button  class="btn btn-link" ><i class="fa fa-trash"></i></button>
                                                <span class="btn btn-link" onclick="showEditChild(this)"><i class="fa fa-edit"></i></span>
                                                {!! Form::close() !!}
                                                {!! Form::model( $item , ['route' => ['itmes.update' , $item->id ], 'role' => 'form' , 'style' => 'display: none']) !!}
                                                {{ method_field('patch') }}
                                                <div class="box-body">
                                                    @include('Zoolflat::fileds.php.text' , ['name' => 'name_ar' , 'value' => $item->name_ar , 'label' => trans('zoolflat::zoolflat.Item name Arabic')])
                                                    @include('Zoolflat::fileds.php.text' , ['name' => 'name_en' , 'value' => $item->name_en , 'label' => trans('zoolflat::zoolflat.Item name English')])
                                                    @include('Zoolflat::fileds.php.text' , ['name' => 'icon' , 'value' => $item->icon , 'label' => trans('zoolflat::zoolflat.icon'), 'placeholder' => '<i class="fa fa-trash"></i>'])
                                                    @include('Zoolflat::fileds.php.text' , ['name' => 'link', 'value' => $item->link  , 'label' => trans('zoolflat::zoolflat.link')])
                                                    @include('Zoolflat::fileds.php.select' , ['name' => 'parent_id', 'value' => $item->parent_id  ,  'label' => trans('zoolflat::zoolflat.Parent Item') , 'array' => [ 0 => trans('zoolflat::zoolflat.No parent menu')] + array_except( $parents, $item->id)])
                                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    {!! Form::submit(trans('zoolflat::zoolflat.Save') , ['class' => 'btn btn-info']) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </section>


@endsection

@push('js')
    <script>
        function showEdit(e) {
            $(e).closest('tr').next('tr').toggle(100);
        }
        function showChilds(e) {
            $(e).closest('tr').next('tr').next('tr').toggle(100);
        }
        function showEditChild(e) {
            $(e).closest('form').next('form').toggle(100);
        }
    </script>
@endpush
