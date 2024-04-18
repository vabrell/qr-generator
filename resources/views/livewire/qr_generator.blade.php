<div class="p-4">
    <h1 class="mb-6 text-xl">QR Generator</h1>
    <div class="flex gap-20">
        <div class="flex flex-col gap-4">
            <h2 class="text-lg text-teal-500">Settings</h2>

            <div class="flex flex-col">
                <label for="qr-data">Data</label>
                <input
                    id="qr-data"
                    type="text"
                    wire:model.live="data"
                    class="border-b border-gray-200 focus:outline-0 focus:border-teal-500"
                />
            </div>

            <div class="flex flex-col">
                <label for="qr-logo">Logo</label>
                <input
                    id="qr-logo"
                    type="file"
                    wire:model.live="logo"
                    class="focus:outline-0 focus:border-teal-500"
                />
            </div>

            <button
                wire:click="save"
                class="w-fit py-1 px-2 rounded bg-teal-400 text-teal-900"
            >
                Create QR Code
            </button>
        </div>

        <div>
            <h2 class="text-lg text-teal-500">Preview</h2>
            <img src="{{$qrCode}}" />
        </div>
    </div>
</div>
