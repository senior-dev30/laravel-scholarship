const canvas = document.getElementById('signatureData-canvas');
const ctx = canvas.getContext('2d');
const modeToggleBtn = document.getElementById('modeToggleBtn');
const signatureTextInput = document.getElementById('signatureTextInput');

let isDrawMode = true;
let drawing = false;
let lastX = 0;
let lastY = 0;
function getPos(e) {
    const rect = canvas.getBoundingClientRect();
    if (e.touches) {
        return {
            x: e.touches[0].clientX - rect.left,
            y: e.touches[0].clientY - rect.top,
        };
    } else {
        return {
            x: e.clientX - rect.left,
            y: e.clientY - rect.top,
        };
    }
}
function startDraw(e) {
    if (!isDrawMode) return;
    e.preventDefault();
    drawing = true;
    const pos = getPos(e);
    lastX = pos.x;
    lastY = pos.y;
}
function draw(e) {
    if (!drawing || !isDrawMode) return;
    e.preventDefault();
    const pos = getPos(e);
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(pos.x, pos.y);
    ctx.strokeStyle = 'black';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.stroke();
    lastX = pos.x;
    lastY = pos.y;
}
function stopDraw(e) {
    if (!isDrawMode) return;
    e.preventDefault();
    drawing = false;
}
function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}
function renderText(text) {
    if (isDrawMode) {
        clearCanvas();
        ctx.font = '48px cursive';
        ctx.fillStyle = 'black';
        ctx.textBaseline = 'middle';
        const x = 20;
        const y = canvas.height / 2;
        ctx.fillText(text, x, y);
    }
}

function isCanvasEmpty(canvas) {
    const blank = document.createElement('canvas');
    blank.width = canvas.width;
    blank.height = canvas.height;
    return canvas.toDataURL() === blank.toDataURL();
}

// Drawing event listeners
canvas.addEventListener('mousedown', startDraw);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDraw);
canvas.addEventListener('mouseout', stopDraw);
canvas.addEventListener('touchstart', startDraw);
canvas.addEventListener('touchmove', draw);
canvas.addEventListener('touchend', stopDraw);
canvas.addEventListener('touchcancel', stopDraw);
// Toggle mode button logic
modeToggleBtn.addEventListener('click', () => {
    isDrawMode = !isDrawMode;
    if (isDrawMode) {
        modeToggleBtn.textContent = 'Switch to Text Mode';
        signatureTextInput.classList.add('hidden');
        signatureTextInput.classList.remove('text-black');
        signatureTextInput.classList.add('text-transparent');
        canvas.style.cursor = 'crosshair';
        clearCanvas();
        signatureTextInput.value = '';
    } else {
        modeToggleBtn.textContent = 'Switch to Draw Mode';
        signatureTextInput.classList.remove('hidden');
        canvas.style.cursor = 'default';
        signatureTextInput.classList.remove('text-transparent');
        signatureTextInput.classList.add('text-black');
        signatureTextInput.focus();
        signatureTextInput.value = '';
        clearCanvas();
    }
});
// Update canvas text on input
signatureTextInput.addEventListener('input', (e) => {
    if (!isDrawMode) {
        renderText(e.target.value);
    }
});
// Clear button clears canvas and input if text mode
document.getElementById('clear').addEventListener('click', () => {
    clearCanvas();
    if (!isDrawMode) {
        signatureTextInput.value = '';
    }
});

const btn = document.getElementById('toggleSidebar');
const sidebar = document.getElementById('sidebar');
let isSidebarOpen = false;

btn.addEventListener('click', (e) => {
    if (!isSidebarOpen) sidebar.classList.toggle('translate-x-full');
    if (!isSidebarOpen) isSidebarOpen = !sidebar.classList.contains('translate-x-full');
});

document.getElementById('scholarshipForm').addEventListener('submit', function (e) {
    if (isDrawMode) {
        if (isCanvasEmpty(canvas)) {
            e.preventDefault();
            alert('Please draw your signature.');
            return;
        }
        // Save canvas as dataURL in hidden input
        signatureTextInput.value = canvas.toDataURL('image/png');
    } else {
        if (!signatureTextInput.value.trim()) {
            e.preventDefault();
            alert('Please type your signature.');
            return;
        }
    }
});

document.addEventListener('click', function (e) {
    // Defer this to ensure toggle button logic finishes
    setTimeout(() => {
        const isClickInsideSidebar = sidebar.contains(e.target);
        const isClickOnToggleBtn = btn.contains(e.target);

        if (!isClickInsideSidebar && !isClickOnToggleBtn && isSidebarOpen) {
            sidebar.classList.add('translate-x-full'); // Close sidebar
            isSidebarOpen = false;
        }
    }, 10);
});
