<?php

// Show All Errors
ini_set('display_errors', true);
error_reporting(E_ALL);

// Define Asana API Key
define('ASANA_API_KEY', 'REPLACE THIS');
define('ASANA_WORKSPACE_ID', 'REPLACE THIS');

// Include Asana API Class
require_once('asana.php');

// Initialize Asana API Class
$asana = new Asana(ASANA_API_KEY);

// Get the projects
$projects = json_decode($asana->getProjectsInWorkspace(ASANA_WORKSPACE_ID));
if (!is_object($projects) || empty($projects->data)) {
	die('No projects available in workspace.');
}

$data = array();
foreach ($projects->data as $project) {
	$completedCount = 0;
	$tasks = json_decode($asana->getTasksByProjectId($project->id, 'completed'));
	if (!is_object($tasks) || empty($tasks->data)) {
		continue;
	}
	foreach ($tasks->data as $task) {
		$completedCount += (int) $task->completed;
	}
	$data[$project->id] = array(
		'name'           => $project->name,
		'completedCount' => $completedCount,
		'totalCount'     => count($tasks->data)
	);
}

include_once('views/table.php');