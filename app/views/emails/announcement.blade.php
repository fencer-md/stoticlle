@extends('emails.base')

@section('title')
    <h2>Анонс</h2>
@stop

@section('content')
    <div>
        Новый анонс будет в течении 10 минут ({{ $date->format('d.m.Y H:i:s') }})
    </div>
@stop