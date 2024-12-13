<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToTeam
{
	protected static function bootBelongsToTeam()
	{
		static::addGlobalScope(new TeamScope);

		static::creating( function($model) {
			if(session()->has('current_team_id')) {
				$model->team_id = session()->get('current_team_id');
			}
		});
	}

	public function team(): BelongsTo
	{
		return $this->belongsTo(Team::class);
	}
}