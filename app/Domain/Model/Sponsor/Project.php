<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Project extends Model
{

	protected $fillable = ['id', 'name', 'scope'];

	public static function getProjectsSelection()
	{
		$projects = Project::orderBy('scope', 'asc')->orderBy('name', 'asc')->get();
		$projectsSelection = array();
		foreach ($projects as $project) {
			switch ($project->scope) {
				case 'project':
					$scope = ' (Projekt)';
					break;
				case 'person':
					$scope = ' (Person)';
					break;
				default:
					$scope = '';
					break;
			}
			$projectsSelection[$project->id] = $project->name . $scope;
		}
		return $projectsSelection;
	}

	public static function validatorCreate(array $data)
	{
		return Validator::make($data, [
					'id' => 'required|numeric|between:0,9999999999|unique:projects',
					'name' => 'required|max:255',
					'scope' => 'required|in:person,project',
		]);
	}

	public static function validatorUpdate(array $data)
	{
		return Validator::make($data, [
					'name' => 'required|max:255',
					'scope' => 'required|in:person,project',
		]);
	}

}
