<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Activity;
use App\Models\Berita;
use App\Models\ContactInformation;
use App\Models\PotensiPadukuhan;
use App\Models\ProfilePadukuhan;
use App\Models\SocialMedia;
use App\Models\Umkm;
use App\Models\UmkmProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteUnusedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:unused-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected array $models = [
        ContactInformation::class => 'thumbnail',
        SocialMedia::class => 'logo',
        ProfilePadukuhan::class => 'struktur_pemerintahan',
        ProfilePadukuhan::class => 'thumbnail_sejarah',
        ProfilePadukuhan::class => 'thumbnail_deskripsi',
        PotensiPadukuhan::class => 'thumbnail',
        Berita::class => 'thumbnail',
        Activity::class => 'thumbnail',
        Umkm::class => 'thumbnail',
        UmkmProduct::class => 'thumbnail',
        Account::class => 'logo',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $contact = ContactInformation::pluck('thumbnail')->toArray();

        $usedFiles = collect();

        foreach ($this->models as $model => $attribute) {
            $files = $model::pluck($attribute)->filter()->toArray();
            $usedFiles = $usedFiles->merge($files);
        }

        $usedFiles = $usedFiles->unique();

        collect(Storage::disk('public')->allFiles())
            ->reject(fn (string $file) => $file === '.gitignore')
            ->reject(fn (string $file) => $usedFiles->contains($file))
            ->each(fn ($file) => Storage::disk('public')->delete($file));
    }
}
