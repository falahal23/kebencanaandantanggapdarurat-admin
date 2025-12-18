<script src="{{ asset('assets-admin/js/plugins/chartjs.min.js') }}" async></script>
<script src="{{ asset('assets-admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
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



