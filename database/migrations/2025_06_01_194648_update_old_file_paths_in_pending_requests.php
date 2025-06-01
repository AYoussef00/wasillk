<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create directories if they don't exist
        if (!File::exists(storage_path('app/public/licenses'))) {
            File::makeDirectory(storage_path('app/public/licenses'), 0755, true);
        }
        if (!File::exists(storage_path('app/public/ids'))) {
            File::makeDirectory(storage_path('app/public/ids'), 0755, true);
        }

        // Create a simple placeholder image
        $defaultImage = public_path('assets/images/placeholder.jpg');
        if (!File::exists($defaultImage)) {
            // Create directory if it doesn't exist
            File::makeDirectory(dirname($defaultImage), 0755, true, true);
            
            // Create a simple 1x1 pixel black JPEG image
            $im = imagecreatetruecolor(400, 300);
            $textColor = imagecolorallocate($im, 255, 255, 255);
            $bgColor = imagecolorallocate($im, 200, 200, 200);
            imagefilledrectangle($im, 0, 0, 399, 299, $bgColor);
            imagestring($im, 5, 150, 140, 'No Image Available', $textColor);
            imagejpeg($im, $defaultImage);
            imagedestroy($im);
        }

        // Copy default image to storage for licenses
        $defaultLicensePath = 'licenses/default_license.jpg';
        File::copy($defaultImage, storage_path('app/public/' . $defaultLicensePath));

        // Copy default image to storage for IDs
        $defaultIdPath = 'ids/default_id.jpg';
        File::copy($defaultImage, storage_path('app/public/' . $defaultIdPath));

        // Update records with DL12345
        DB::table('pending_requests')
            ->where('driving_licence', 'DL12345')
            ->update(['driving_licence' => $defaultLicensePath]);

        // Update records with NID12345
        DB::table('pending_requests')
            ->where('national_id', 'NID12345')
            ->update(['national_id' => $defaultIdPath]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to old values
        DB::table('pending_requests')
            ->where('driving_licence', 'licenses/default_license.jpg')
            ->update(['driving_licence' => 'DL12345']);

        DB::table('pending_requests')
            ->where('national_id', 'ids/default_id.jpg')
            ->update(['national_id' => 'NID12345']);

        // Remove default images
        File::delete(storage_path('app/public/licenses/default_license.jpg'));
        File::delete(storage_path('app/public/ids/default_id.jpg'));
        File::delete(public_path('assets/images/placeholder.jpg'));
    }
};
