<script src="{{ asset('assets-admin/js/plugins/chartjs.min.js') }}" async></script>
<script src="{{ asset('assets-admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('assets-admin/js/soft-ui-dashboard-tailwind.js?v=1.0.5') }}" async></script>
<script src="{{ asset('js/avatar-dropdown.js') }}"></script>
<script>
function previewMedia(input) {
    const preview = document.getElementById('media-preview');
    preview.innerHTML = '';

    Array.from(input.files).forEach(file => {
        const box = document.createElement('div');
        box.className =
            'w-[80px] h-[100px] border rounded-lg overflow-hidden flex flex-col items-center justify-center bg-white shadow-sm';

        // IMAGE
        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full h-[80px] object-cover';
            box.appendChild(img);

        // VIDEO
        } else if (file.type.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.className = 'w-full h-[80px] object-cover';
            video.muted = true;
            box.appendChild(video);

        // FILE
        } else {
            const span = document.createElement('span');
            span.className =
                'text-[10px] text-center px-1 leading-tight';
            span.innerText = file.name;
            box.appendChild(span);
        }

        preview.appendChild(box);
    });
}
</script>

<script>
    const previewBox = document.getElementById('preview-box');
    const fileInput  = document.getElementById('media-input');
    let preview      = document.getElementById('preview-media');

    // Klik preview → buka file chooser
    previewBox.addEventListener('click', () => {
        fileInput.click();
    });

    // Saat file dipilih
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        const type = file.type;

        // IMAGE
        if (type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        // VIDEO
        else if (type.startsWith('video/')) {
            previewBox.innerHTML = `
                <video class="w-44 h-44 rounded-xl border shadow-sm" controls>
                    <source src="${URL.createObjectURL(file)}" type="${type}">
                </video>
                <p class="mt-3 text-sm text-gray-600 text-center">
                    Klik area untuk ganti file
                </p>
            `;
        }

        // PDF
        else if (type === 'application/pdf') {
            previewBox.innerHTML = `
                <div class="flex flex-col items-center justify-center gap-2">
                    <i class="fas fa-file-pdf text-red-600 text-5xl"></i>
                    <p class="text-sm font-medium text-gray-700 truncate max-w-xs">
                        ${file.name}
                    </p>
                    <p class="text-xs text-gray-500">
                        Klik area untuk ganti file
                    </p>
                </div>
            `;
        }
    });
</script>


