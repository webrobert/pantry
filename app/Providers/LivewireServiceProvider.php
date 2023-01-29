<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Redirector;
use Livewire\Component;

class LivewireServiceProvider extends ServiceProvider
{
	public function boot()
	{
		Redirector::macro('withToaster', fn($message, $type = 'success') =>
			session()->flash('app_toaster', [ 'message' => $message, 'type' => $type ])
		);
		Component::macro('withToaster', fn($message, $type = 'success') =>
			session()->flash('app_toaster', [ 'message' => $message, 'type' => $type ])
		);
		Component::macro('browserToaster', function ($message, $type = 'success') {
			$this->dispatchBrowserEvent('notify', ['message' => $message, 'type' => $type]);
		});
	}
}