<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

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

}
