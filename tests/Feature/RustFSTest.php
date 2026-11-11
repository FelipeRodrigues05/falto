<?php declare(strict_types = 1);

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

test('it uploads a file to rustfs', function () {
    $disk     = Storage::disk('s3');
    $fileName = 'rustfs-smoke-test-' . Str::uuid() . '.txt';
    $content  = 'Hello World RustFS';

    try {
        expect($disk->put($fileName, $content))->toBeTrue()
            ->and($disk->exists($fileName))->toBeTrue()
            ->and($disk->get($fileName))->toBe($content);
    } finally {
        $disk->delete($fileName);
    }
});
