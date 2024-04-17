import SignaturePad from 'signature_pad';

import Swal from 'sweetalert2'; // Importa SweetAlert

document.addEventListener("livewire:load", function () {
    let canvas = document.getElementById('signature-canvas');
    let signaturePad = new SignaturePad(canvas);
});