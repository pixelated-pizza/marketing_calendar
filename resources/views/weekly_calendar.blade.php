@extends('welcome')

@section('title', 'Weekly Calendar')

@section('content')

<section>
    <div style="margin-bottom:10px;">
        <button id="add-event" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add Event</button>
    </div>
    <div id="gantt_here" style="width:100%; height:600px;"></div>
</section>

@endsection