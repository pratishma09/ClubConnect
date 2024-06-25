@extends('layout.user')

@section('users')
<p class="text-3xl text-center my-5 font-semibold text-violet-500">Clubs</p>
<div class="mx-10 flex flex-wrap gap-10">
    @foreach($clubs as $club)
    <button class="text-white rounded-md bg-gray-500 py-5 px-10 transition mb-5 hover:scale-110 flex flex-col items-center justify-center" onclick="openModal('modelConfirm{{ $club->id }}')">
            <img src="{{ asset('assets/' . $club->logo) }}" class="h-20 w-20 object-contain bg-white rounded-full">
            <p class="mt-3">{{$club->name}}</p>
     </button>
     
     <div id="modelConfirm{{ $club->id }}" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 modal">
         <div class="relative top-20 mx-auto shadow-xl bg-white max-w-xl overflow-y-auto">
     
             <div class="flex justify-end p-2">
                 <button onclick="closeModal('modelConfirm{{ $club->id }}')" type="button"
                     class="text-purple-400 bg-transparent hover:bg-purple-200 hover:text-purple-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd"
                             d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                             clip-rule="evenodd"></path>
                     </svg>
                 </button>
             </div>
     
             <div class="p-6 pt-0">
                 
                 <h3 class="text-xl font-normal text-palette mt-5 mb-6 text-center">{{$club->name}}</h3>
                 <div class="flex items-center justify-center mb-5">
                    <img src="{{ asset('assets/' . $club->logo) }}" class="h-24 w-24 object-contain rounded-full">
                 </div>
                 
                 <p class="px-3 font-medium text-gray-500 text-xl"></p>
                 <p
                     class=" text-black focus:ring-4 focus:ring-red-300 rounded-lg text-base inline-flex text-justify items-center px-3 py-2.5 mr-2">
                     {{$club->description}}
                 </p>

                 <p class="px-3 font-medium text-gray-500 text-xl">Tenure Date</p>
                 <p
                     class=" text-black focus:ring-4 focus:ring-red-300 rounded-lg text-base inline-flex text-justify items-center px-3 py-2.5 mr-2">
                     {{$club->tenure_date}}
                 </p>

                 <p class="px-3 font-medium text-gray-500 text-xl">President</p>
                 <p
                     class=" text-black focus:ring-4 focus:ring-red-300 rounded-lg text-base inline-flex text-justify items-center px-3 py-2.5 mr-2">
                     {{$club->president}}
                 </p>

                 <p class="px-3 font-medium text-gray-500 text-xl">Vice President</p>
                 <p
                     class=" text-black focus:ring-4 focus:ring-red-300 rounded-lg text-base inline-flex text-justify items-center px-3 py-2.5 mr-2">
                     {{$club->vice_president}}
                 </p>
                 
             </div>
     
         </div>
     </div>
     @endforeach
</div>
@endsection
<script type="text/javascript">
    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function(event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };
</script>
