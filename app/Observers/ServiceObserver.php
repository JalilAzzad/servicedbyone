<?php

namespace App\Observers;

use App\Models\Service;

class ServiceObserver
{
    /**
     * Handle to the service "created" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        $this->handleImageUpload($service);
    }

    /**
     * Handle the service "updated" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function updated(Service $service)
    {
        $this->handleImageUpload($service);
    }

    /**
     * Handle the service "deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function deleted(Service $service)
    {
        //
    }


    private function handleImageUpload(Service $service)
    {
        if(!is_null($service->featured_image))
        {
            // open an image file
            $img = \Image::make(storage_path('app/'.$service->featured_image));
            // now you are able to resize the instance
            $img->fit(600, 300);
            // finally we save the image as a new file
            $filepath = str_replace('.', '-600x300.', $service->featured_image);
            $img->save(storage_path('app/'.$filepath));

            $service->update(['resized_featured_image' => $filepath]);
        }
    }
}
