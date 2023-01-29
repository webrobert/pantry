require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.$notify = {

    success(message) {
        this.sendit(message, 'success')
    },

    error(message) {
        this.sendit(message, 'error')
    },

    sendit(message, type) {
        window.dispatchEvent(
            new CustomEvent( 'notify', { detail: {  message : message, type : type } } )
        );
    }
}

Livewire.on('modal', data => { $modals.show(data.modal, data.message) })
