<?php

namespace App\Http\Mechanism;

use App\Exceptions\OliveMedikaException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageManager
{
	/**
	 * Store image in storage/app/public/OliveMedika/img
	 * @param string $filename file name without format, format will follow uploaded image format
	 * @param UploadedFile $image
	 * @param string $path relative path from storage/app/public/OliveMedika/img
	 * @return string
	 * @throws OliveMedikaException
	 */
	static public function saveImage(string $filename, UploadedFile $image, string $path = ''): string
	{
		if ($path !== '') {
			$path = '/' . $path;
		}
		$path = Storage::putFileAs(
			'public/OliveMedika/img' . $path,
			$image,
			$filename . '.' . $image->clientExtension()
		);
		if (!$path) {
			throw new OliveMedikaException('Failed to save image', 2003);
		}
		return $path;
	}
}