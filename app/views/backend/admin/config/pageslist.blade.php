@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Pages list</h3>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <td>Page title</td>
                <td>Updated</td>
                <td></td>
            </thead>
            <tbody>
        @foreach ( $pages as $page )
                <tr>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->updated_at }}</td>
                    <td>
                        <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/page/'.$page->id) }}"><i class="fa fa-edit"></i>Edit</a>
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </div>
@stop