@extends('adminlte::page')

@section('title', 'ダッシュボード')

@section('content_header')
    <h1>ダッシュボード</h1>
@stop

@section('content')
    <?php
    date_default_timezone_set('Asia/Tokyo');
    $hour = date('H');
    $greeting = '';

    if ($hour >= 6 && $hour <= 10) {
        $greeting = 'おはようございます';
    } elseif ($hour >= 11 && $hour <= 15) {
        $greeting = 'こんにちは';
    } elseif ($hour >= 16 && $hour <= 20) {
        $greeting = 'こんばんは';
    } elseif ($hour >= 21 && $hour <= 24) {
        $greeting = 'お疲れ様です。お早めにおやすみください';
    } else {
        $greeting = 'zzZ';
    }
    ?>

    <p>{{ Auth::user()->name }}さん、{{ $greeting }}！</p>
@stop

@section('css')
    <!-- {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}} -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
 
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
