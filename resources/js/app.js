import './bootstrap';
import SignaturePad from 'signature_pad';

document.addEventListener("livewire:load", function () {
    let canvas = document.getElementById('signature-canvas');
    let signaturePad = new SignaturePad(canvas);
});