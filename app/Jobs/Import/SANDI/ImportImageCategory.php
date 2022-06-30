<?php

namespace App\Jobs\Import\SANDI;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportImageCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function handle(CategoryService $service)
    {
        $service->syncImage($this->category);
    }
}
