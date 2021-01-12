<?php
/** @var \App\Models\User $user */
/** @var \App\Models\role[] $roles */
?>
@extends('Dashboard.template.template')
@section('content')
    {{Aire::open()->bind($user)->action(url('user/edit'))}}
    {{Aire::hidden('id',$user->id)}}
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('name','Nama User')->id('name')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('username','Username Login')->id('username')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::password('password','Password')->id('password')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            <?php
            $array = [];
            foreach ($roles as $role){
                $array[$role->id] = $role->nama;
            }
            ?>
            {{Aire::select($array,'role','Role')->id('role')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::submit('Input User')}}
        </div>
    </div>
    {{ Aire::close() }}
@endsection
