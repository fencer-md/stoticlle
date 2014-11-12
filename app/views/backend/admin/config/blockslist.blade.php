@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Blocks list</h3>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <td>Page title</td>
                <td>Updated</td>
                <td></td>
            </thead>
            <tbody>
        @foreach ( $blocks as $block )
                <tr>
                    <td>{{ $block->title }}</td>
                    <td>{{ $block->updated_at }}</td>
                    <td>
                        @if ( $block->title == 'main-block' )
                            <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/block/'.$block->id) }}"><i class="fa fa-edit"></i>Edit</a>
                        @elseif ( $block->title == 'block-1' || $block->title == 'block-2' || $block->title == 'block-3' )
                            <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/block/'.$block->id) }}"><i class="fa fa-edit"></i>Edit</a>
                        @elseif ( $block->title == 'partners' )
                            <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/block/'.$block->id) }}"><i class="fa fa-edit"></i>Edit</a>
                        @endif
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </div>
@stop