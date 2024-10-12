@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
           
@section('header', "Une erreur inattendue s'est produite.")
@section('message',  "Nous sommes désolé pour le dérangement causé.")

