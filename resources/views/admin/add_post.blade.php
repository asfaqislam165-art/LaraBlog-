{{-- @extends('layouts.app') --}}


@section('content')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100"  style="text-align:center;  border:1px solid">
                    @if (session('status'))
                    <div style="background-color:rgb(120, 235, 158);"   class="alert alert successs">

                    {{session('status')}}

                    </div>
                    @endif


                    <form action="{{route('admin.createpost')}}"   method="post"  enctype="multipart/form-data">
                        @csrf
                    
                        <input type="text"  name='title'  placeholder="Enter Post Title Here!"><br><br><br>

                        <textarea style="width:400px; height:200px "    name="description" id="">
                            Write post Here 
                        </textarea><br><br><br>
                        
                        <input type="file"  name="image"><br><br><br>
                        <input style="border:1px solid blue; text-align:center; padding:10px " type="submit"  name="submit"   value="add post ">

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- @endsection --}}