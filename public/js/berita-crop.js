/*
 * MI Darul Ulum Gedongan — editor foto Berita
 * Cocok dengan Cropper.js v1.6.2 (bukan v2.x).
 * Berjalan di halaman Tambah/Edit, tidak mengubah form CRUD lain.
 */
(function () {
    'use strict';

    function ready() {
        const fileInput = document.getElementById('gambar');
        const ratioInput = document.getElementById('rasio');
        const modal = document.getElementById('photo-crop-modal');
        if (!fileInput || !ratioInput || !modal) return;

        const sourceImage = document.getElementById('crop-source');
        const preview = document.getElementById('photo-preview');
        const previewBox = document.getElementById('photo-preview-box');
        const status = document.getElementById('photo-crop-status');
        const recropButton = document.getElementById('reopen-crop');
        const applyButton = document.getElementById('apply-crop');
        const closeButton = document.getElementById('close-crop');
        const cancelButton = document.getElementById('cancel-crop');
        const ratioButtons = Array.from(modal.querySelectorAll('[data-crop-ratio]'));
        const form = fileInput.closest('form');
        const ratios = {
            '16:9': { value: 16 / 9, maxWidth: 1280, maxHeight: 720 },
            '3:4':  { value: 3 / 4, maxWidth: 900, maxHeight: 1200 },
            '9:16': { value: 9 / 16, maxWidth: 720, maxHeight: 1280 },
            '1:1':  { value: 1, maxWidth: 1000, maxHeight: 1000 },
        };

        let cropper = null;
        let originalUrl = null;
        let previewUrl = null;
        let selectedRatio = ratios[ratioInput.value] ? ratioInput.value : '16:9';
        let pendingCrop = false;
        let previousFocus = null;
        let requestId = 0;
        const initialRatio = selectedRatio;
        let acceptedFile = null;
        let acceptedRatio = initialRatio;

        function setStatus(message, isError = false) {
            status.textContent = message;
            status.classList.toggle('text-red-700', isError);
            status.classList.toggle('text-slate-600', !isError);
        }

        function clearUrl(url) {
            if (url) URL.revokeObjectURL(url);
        }

        function destroyCropper() {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }

        function updateRatioButtons() {
            ratioButtons.forEach((button) => {
                const active = button.dataset.cropRatio === selectedRatio;
                button.setAttribute('aria-pressed', String(active));
                button.classList.toggle('bg-secondary', active);
                button.classList.toggle('text-white', active);
                button.classList.toggle('border-secondary', active);
            });
            if (cropper) cropper.setAspectRatio(ratios[selectedRatio].value);
        }

        function hideModal() {
            destroyCropper();
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (previousFocus && typeof previousFocus.focus === 'function') previousFocus.focus();
        }

        function cancelCrop() {
            // File input masih memuat foto mentah jika crop belum diterapkan.
            // Jangan izinkan file mentah tersimpan secara tidak sengaja.
            if (pendingCrop) {
                if (acceptedFile) {
                    const restore = new DataTransfer();
                    restore.items.add(acceptedFile);
                    fileInput.files = restore.files;
                    ratioInput.value = acceptedRatio;
                    selectedRatio = acceptedRatio;
                    setStatus('Crop dibatalkan. Foto yang sudah disetujui sebelumnya tetap dipakai.');
                } else {
                    fileInput.value = '';
                    ratioInput.value = initialRatio;
                    selectedRatio = initialRatio;
                    setStatus('Crop dibatalkan. Pilih ulang foto untuk mengunggah.');
                }
                pendingCrop = false;
            }
            hideModal();
        }

        function openModal() {
            if (!originalUrl) return;
            if (typeof window.Cropper !== 'function') {
                fileInput.value = '';
                pendingCrop = false;
                setStatus('Editor crop gagal dimuat. Periksa koneksi internet lalu refresh halaman.', true);
                return;
            }
            destroyCropper();
            previousFocus = document.activeElement;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            sourceImage.src = originalUrl;
            updateRatioButtons();
            applyButton.focus();
            // Cropper perlu ukuran container yang sudah terlihat.
            requestAnimationFrame(() => {
                cropper = new window.Cropper(sourceImage, {
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.88,
                    aspectRatio: ratios[selectedRatio].value,
                    responsive: true,
                    background: false,
                    movable: true,
                    zoomable: true,
                });
            });
        }

        fileInput.addEventListener('change', function () {
            const file = fileInput.files?.[0];
            if (!file) return;
            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                fileInput.value = '';
                setStatus('Hanya file JPG, PNG, atau WebP yang didukung.', true);
                return;
            }
            if (file.size > 12 * 1024 * 1024) {
                fileInput.value = '';
                setStatus('Foto sumber maksimal 12 MB. Pilih foto lain.', true);
                return;
            }
            clearUrl(originalUrl);
            originalUrl = URL.createObjectURL(file);
            pendingCrop = true;
            openModal();
        });

        ratioButtons.forEach((button) => {
            button.addEventListener('click', () => {
                selectedRatio = button.dataset.cropRatio;
                updateRatioButtons();
            });
        });

        async function applyCrop() {
            if (!cropper) return;
            const id = ++requestId;
            applyButton.disabled = true;
            applyButton.textContent = 'Memproses...';
            try {
                const { maxWidth, maxHeight } = ratios[selectedRatio];
                const canvas = cropper.getCroppedCanvas({
                    maxWidth,
                    maxHeight,
                    fillColor: '#ffffff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });
                if (!canvas) throw new Error('Gagal menyiapkan gambar hasil crop.');
                const blob = await new Promise((resolve, reject) => {
                    canvas.toBlob(
                        (result) => result ? resolve(result) : reject(new Error('Gagal mengubah hasil crop menjadi JPG.')),
                        'image/jpeg',
                        0.87
                    );
                });
                if (id !== requestId) return;
                if (blob.size > 2 * 1024 * 1024) {
                    throw new Error('Hasil crop melebihi 2 MB. Pilih foto dengan detail lebih sedikit.');
                }
                // Ganti input asli dengan file hasil crop. Laravel tetap menerima $request->file('gambar').
                const newFile = new File([blob], `berita-${Date.now()}.jpg`, { type: 'image/jpeg' });
                const transfer = new DataTransfer();
                transfer.items.add(newFile);
                fileInput.files = transfer.files;
                acceptedFile = newFile;
                acceptedRatio = selectedRatio;
                ratioInput.value = selectedRatio;
                pendingCrop = false;

                clearUrl(previewUrl);
                previewUrl = URL.createObjectURL(blob);
                preview.src = previewUrl;
                previewBox.classList.remove('hidden');
                recropButton.classList.remove('hidden');
                setStatus(`Foto siap disimpan • rasio ${selectedRatio} • ${(blob.size / 1024).toFixed(0)} KB`);
                hideModal();
            } catch (error) {
                setStatus(error.message || 'Crop gagal. Coba lagi.', true);
                window.alert(error.message || 'Crop gagal. Coba lagi.');
            } finally {
                applyButton.disabled = false;
                applyButton.textContent = 'Gunakan Foto';
            }
        }

        applyButton.addEventListener('click', applyCrop);
        cancelButton.addEventListener('click', cancelCrop);
        closeButton.addEventListener('click', cancelCrop);
        recropButton.addEventListener('click', () => {
            if (originalUrl) openModal();
        });
        modal.addEventListener('click', (event) => {
            if (event.target === modal) cancelCrop();
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                cancelCrop();
            }
        });
        form?.addEventListener('submit', (event) => {
            if (pendingCrop) {
                event.preventDefault();
                setStatus('Selesaikan proses crop foto dulu sebelum menyimpan berita.', true);
                openModal();
            }
        });
        window.addEventListener('beforeunload', () => {
            clearUrl(originalUrl);
            clearUrl(previewUrl);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', ready, { once: true });
    } else {
        ready();
    }
})();
