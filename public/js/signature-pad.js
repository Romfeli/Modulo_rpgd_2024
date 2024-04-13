// JavaScript
let signaturePad; // Variable para el objeto SignaturePad
let haComenzadoDibujo = false; // Variable para controlar si se ha iniciado el dibujo

// Función para manejar el inicio del dibujo
function handleMouseDown(event) {
    haComenzadoDibujo = true;
}

// Función para manejar el movimiento del mouse
function handleMouseMove(event) {
    if (!haComenzadoDibujo) {
        return;
    }

    const x = event.clientX - signaturePad.canvas.getBoundingClientRect().left;
    const y = event.clientY - signaturePad.canvas.getBoundingClientRect().top;

    signaturePad.strokeMoveTo(x, y);
    signaturePad.stroke();
}

// Función para manejar el fin del dibujo
function handleMouseUp() {
    haComenzadoDibujo = false;
}

// Función para mostrar la firma y enviarla al servidor
function showSignatureAndSubmit() {
    Livewire.emit('openSignatureModal');
}
