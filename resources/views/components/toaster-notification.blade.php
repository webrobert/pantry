<div x-cloak
     x-data="{
        isOpen : false,
        type : 'success',
        messageText: '',
        showNotification(message, type){
            this.type = type
            this.isOpen = true
            this.messageText = message
            setTimeout(() => { this.isOpen = false }, 3000)
        }
     }"
     @notify.window="showNotification($event.detail.message, $event.detail.type)"
     @if( session('app_toaster') )
     x-init="$nextTick(() => showNotification('{{ session('app_toaster')['message'] }}', '{{ session('app_toaster')['type'] }}'))"
     @endif
     x-show="isOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-x-6"
     x-transition:enter-end="opacity-80 transform translate-x-0"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-80 transform translate-x-0"
     x-transition:leave-end="opacity-0 transform translate-x-6"
     class="fixed alert flex justify-between items-center right-3 bottom-3 sm:left-auto bg-white rounded-md text-sm p-2 pb-2 sm:py-5 sm:px-6 z-50 border shadow-lg space-x-4 opacity-95 sm: sm:m-8 sm:mr-6">

    <div class="font-semibold flex mr-1 sm:mr-4 items-center">
        <svg :class="type == 'success' ? 'text-green-500' : 'text-red-500'" class="h-7 w-7 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-gray-600 sm:text-md" x-text="messageText"></span>
    </div>

    <button @click="isOpen = false" class="text-gray-400">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
