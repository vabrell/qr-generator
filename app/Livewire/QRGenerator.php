<?php

namespace App\Livewire;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\Result\WebPResult;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Writer\WebPWriter;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class QRGenerator extends Component
{
    use WithFileUploads;

    public string $data = "";
    public string $qrCode = "";
    #[Validate('image')]
    public $logo;

    public function updated(string $property): void
    {
        // Render the QR code on updates
        $this->renderQRCode();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.qr_generator');
    }

    public function save(): void
    {
        $result = $this->makeQRCode();
        $result->saveToFile('./qr_ouput.webp');
    }

    public function renderQRCode(): void
    {
        $result = $this->makeQRCode();
        $this->qrCode = $result->getDataUri();
    }

    public function makeQRCode(): WebPResult|null
    {
        if (empty($this->data)) {
            $this->qrCode = "";
            return null;
        }

        $writer = new WebPWriter();

        $qrCode = QrCode::create($this->data)
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::High);

        // Handle logo
        $logo = null;
        if (!empty($this->logo)) {
            $logo = Logo::create($this->logo->getPathname())
                ->setResizeToWidth(150)
                ->setPunchoutBackground(true);
        }
        // Handle label

        // Generate the QR Code
        return $writer->write($qrCode, $logo);
    }
}
