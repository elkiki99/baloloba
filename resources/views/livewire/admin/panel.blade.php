<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;

new class extends Component {
    public $totalPhotoshoots;
    public $lastPhotoshoot;
    public $pendingPhotoshoots;
    public $completedPhotoshoots;
    public $result;

    public function mount()
    {
        $this->totalPhotoshoots = PhotoShoot::count();
        $this->lastPhotoshoot = PhotoShoot::latest()->first();
        $this->pendingPhotoshoots = PhotoShoot::where('status', 'draft')->count();
        $this->completedPhotoshoots = PhotoShoot::where('status', 'published')->count();
        $this->getBucketSize();
    }

    public function getBucketSize()
    {
        $bucket = env('AWS_BUCKET');
        $totalSize = 0;

        try {
            $s3Client = new S3Client([
                'version' => 'latest',
                'region' => env('AWS_DEFAULT_REGION'),
                'endpoint' => env('AWS_ENDPOINT'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);

            $result = $s3Client->listObjectsV2(['Bucket' => $bucket]);

            if (isset($result['Contents'])) {
                foreach ($result['Contents'] as $object) {
                    if (isset($object['Size'])) {
                        $totalSize += $object['Size'];
                    }
                }
            }

            // Convert to MB
            $totalSizeInMB = $totalSize / (1024 * 1024);

            $this->result = [
                'totalSizeInBytes' => $totalSize,
                'totalSizeInMB' => round($totalSizeInMB, 2),
            ];
        } catch (\Exception $e) {
            $this->result = 'Error al obtener el tamaño del bucket: ' . $e->getMessage();
        }
        // dd($this->result);
    }
};
?>

<section class="pt-12 pb-[20vh] sm:px-6 lg:px-8 px-0">
    <div class="space-y-6 md:mx-auto sm:mt-10 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Photoshoots -->
            <div
                class="bg-gradient-to-tl from-white hover:via-yellow-100 via-yellow-100/50 to-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold">Photoshoots totales</h3>
                <p class="text-3xl font-bold">{{ $totalPhotoshoots }}</p>
            </div>

            <!-- Completed Photoshoots -->
            <div
                class="bg-gradient-to-tl from-white hover:via-green-100 via-green-100/50 to-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold">Completados</h3>
                <p class="text-3xl font-bold">{{ $completedPhotoshoots }}</p>
            </div>

            <!-- Pending Photoshoots -->
            <div
                class="bg-gradient-to-tl from-white hover:via-blue-100 via-blue-100/50 to-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold">Pendientes</h3>
                <p class="text-3xl font-bold">{{ $pendingPhotoshoots }}</p>
            </div>

            <!-- Storage -->
            <div
                class="bg-gradient-to-tl from-white hover:via-pink-100 via-pink-100/50 to-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold">Almacenamiento</h3>
                <p class="text-3xl font-bold">{{ $result['totalSizeInMB'] }} MB</p>
            </div>
        </div>

        <!-- Last Photoshoot -->
        <div class="mt-6 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold">Último Photoshoot</h3>
            @if ($lastPhotoshoot)
                <div class="my-2">
                    <x-photoshoot-card :photoshoot="$lastPhotoshoot" />
                </div>
            @else
                <p class="text-sm">No hay photoshoots registrados.</p>
            @endif
        </div>
    </div>
</section>
