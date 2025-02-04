import './bootstrap';
import 'admin-lte';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Hacer toastr global si se requiere
window.toastr = toastr;

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

// Ejemplo de uso
toastr.success('Toastr se configuró correctamente.');
