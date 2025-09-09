<div x-data="signaturePad()" class="space-y-2">
    <div class="border rounded">
        <canvas id="signature-canvas" class="w-full" style="height:200px"></canvas>
    </div>
    <div class="flex gap-2">
        <button type="button" @click="clearPad()" class="px-3 py-2 border rounded">Bersihkan</button>
        <button type="button" @click="savePad()" class="px-3 py-2 bg-indigo-600 text-white rounded">Simpan TTD</button>
    </div>
    <input type="hidden" name="signature" x-ref="signatureInput">
</div>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('signaturePad', () => ({
            pad: null,
            init() {
                const canvas = this.$el.querySelector('#signature-canvas');
                // fix canvas size for HiDPI
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = 200 * ratio;
                canvas.getContext('2d').scale(ratio, ratio);
                this.pad = new SignaturePad(canvas, { backgroundColor: 'rgba(255,255,255,0)', penColor: 'black' });
            },
            clearPad() { this.pad.clear(); },
            savePad() { this.$refs.signatureInput.value = this.pad.toDataURL('image/png'); }
        }))
    })
</script>
