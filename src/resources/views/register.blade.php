@extends('layouts.main')

@section('title')
    Accueil
@endsection

@section('content')
<div class="w-full flex-1 flex flex-row items-center justify-evenly">


  <a href="{{ route('register.candidat') }}" 
  class="m-8 w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 
  text-gray-700 dark:text-gray-400 text-center p-10 hover:bg-gray-100 dark:hover:bg-gray-500 hover:text-gray-300 dark:hover:text-gray-300">
    Inscription Candidat
  </a>
  <a href="{{ route('register.user') }}" class="m-8 w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700
  text-gray-700 dark:text-gray-400 text-center p-10 hover:bg-gray-100 dark:hover:bg-gray-500 hover:text-gray-300 dark:hover:text-gray-300">
    Inscription Formateur
  </a>
 
</div>
  
  
@endsection
