<div class="date text-gray-700">
  <img src="{{asset('/storage/photos/clock.png')}}" class="w-10" alt="">
  <span id="weekDay" class="weekDay"></span>, 
  <span id="day" class="day"></span> de <span id="month" class="month"></span> del <span id="year" class="year"></span>
</div>
<div class="clock mt-2 flex items-center text-gray-800">
  <span id="hours" class="hours font-bold text-2xl leading-none mr-1"></span> :
  <span id="minutes" class="minutes font-bold text-2xl leading-none mx-1"></span> :
  <span id="seconds" class="seconds font-bold text-2xl leading-none ml-1"></span>
</div>








<div x-data="{ showModal: false }">
  <!-- Botón para abrir el modal -->

  <div class="mt-6">
    <button @click="showModal = true" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
      <i class="fa-solid fa-user-clock fa-2x mr-2"></i>
      Registrar Asistencia
  </button>
  </div>


  <!-- Modal -->
  <div x-show="showModal" @click.away="showModal = false" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
      <div class="flex items-center justify-center min-h-screen bg-opacity-60 bg-gray-700">
          <div class="relative p-4 w-full max-w-lg mx-auto bg-white rounded-lg shadow-2xl dark:bg-gray-700">
              <div class="absolute top-3 right-2">
                  <button @click="showModal = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-12 h-12 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <div class="p-4 md:p-5 text-center">
                  <span class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" >
                    <i class="fa-solid fa-user-clock fa-3x"></i>
                  </span>
                  
                  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Registro</h3>
                  <!-- Livewire component para confirmar o cancelar la acción -->
                  

         
                  <form class="max-w-sm mx-auto" method="POST" action="{{ route('employee.store') }}">
                    @csrf
                    <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona un estado:</label>
                    <select id="time" name="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Selecciona un estado</option>
                        <option value="in">Entrada</option>
                        <option value="out">Salida</option>
                    </select>
                
                    <!-- Campo oculto para el employee_id -->
                    <input type="hidden" name="employee_id" value="{{ session('employee')->employee_id }}">
                
                    <div class="mt-3">
                        <button type="submit" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            <i class="fa-regular fa-clock"></i> 
                            Registrar Asistencia
                        </button>
                    </div>
                </form>
                
                  
              </div>
          </div>
      </div>
  </div>
</div>

  
  <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <div class="p-4 md:p-5 text-center">
                  <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                  <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                      Yes, I'm sure
                  </button>
                  <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
              </div>
          </div>
      </div>
  </div>
  

<script>
    var udateTime = function() {
      let currentDate = new Date(),
          hours = currentDate.getHours(),
          minutes = currentDate.getMinutes(), 
          seconds = currentDate.getSeconds(),
          weekDay = currentDate.getDay(), 
          day = currentDate.getDate(), 
          month = currentDate.getMonth(), 
          year = currentDate.getFullYear();
  
      const weekDays = [
          'Domingo',
          'Lunes',
          'Martes',
          'Miércoles',
          'Jueves',
          'Viernes',
          'Sabado'
      ];
  
      document.getElementById('weekDay').textContent = weekDays[weekDay];
      document.getElementById('day').textContent = day;
  
      const months = [
          'Enero',
          'Febrero',
          'Marzo',
          'Abril',
          'Mayo',
          'Junio',
          'Julio',
          'Agosto',
          'Septiembre',
          'Octubre',
          'Noviembre',
          'Diciembre'
      ];
  
      document.getElementById('month').textContent = months[month];
      document.getElementById('year').textContent = year;
  
      document.getElementById('hours').textContent = hours;
  
      if (minutes < 10) {
          minutes = "0" + minutes
      }
  
      if (seconds < 10) {
          seconds = "0" + seconds
      }
  
      document.getElementById('minutes').textContent = minutes;
      document.getElementById('seconds').textContent = seconds;
     };
  
     udateTime();
  
      setInterval(udateTime, 1000);
</script>

