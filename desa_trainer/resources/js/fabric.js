const { data } = require("autoprefixer");

let canvas = new fabric.Canvas('c'); // Asegúrate de que el ID del canvas sea 'c'
let isDrawing = false;
let points = [];
let activeShape;
let blinkingIntervals = new Map();

canvas.on('mouse:down', function (options) {
    if (options.e.detail === 2) {
        // Si es doble click, termina el dibujo
        isDrawing = false;
        points = [];
        activeShape = null;
    } else {
        // Si es click normal, añade un punto
        isDrawing = true;
        let pointer = canvas.getPointer(options.e);
        points.push({ x: pointer.x, y: pointer.y });
        drawCircle(pointer.x, pointer.y);
    }
});

canvas.on('mouse:move', function (options) {
    if (isDrawing) {
        let pointer = canvas.getPointer(options.e);
        drawCircle(pointer.x, pointer.y);
    }
});

function drawCircle(x, y) {
    let circle = new fabric.Circle({
        left: x,
        top: y,
        radius: 5,
        fill: 'red',
        selectable: false
    });
    canvas.add(circle);

    // Blinking logic
    let interval = setInterval(() => {
        circle.set('opacity', circle.get('opacity') === 1 ? 0 : 1);
        canvas.renderAll();
    }, 500); // Change 500 to the desired blinking interval in milliseconds

    blinkingIntervals.set(circle, interval);
}

// Evento para iniciar el proceso de dibujo en el lienzo
Livewire.on('startDrawing', () => {
    isDrawing = true;
    points = [];
    activeShape = null;
});

// Evento para resetear el lienzo, manteniendo los botones existentes
Livewire.on('buttonSaved', (data) => {
    clearBlinkingIntervals();
    canvas.clear();
    // Aquí puedes añadir lógica para mantener los botones existentes
});

// Evento para manejar la eliminación de botones y actualizar el lienzo
Livewire.on('buttonDeleted', (data) => {
    // Aquí puedes añadir lógica para eliminar botones y actualizar el lienzo
});

// Cargar una nueva área de dibujo, permitiendo redibujar el área seleccionada y añadir un botón para volver a dibujar
Livewire.on('loadArea', (data) => {
    clearBlinkingIntervals();
    canvas.clear();
    // Aquí puedes añadir lógica para cargar una nueva área de dibujo
});

function clearBlinkingIntervals() {
    blinkingIntervals.forEach((interval, circle) => {
        clearInterval(interval);
    });
    blinkingIntervals.clear();
}