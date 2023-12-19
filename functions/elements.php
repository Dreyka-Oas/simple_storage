<?php
require_once 'users.php';
error_reporting(E_ALL); 
ini_set("display_errors", 1);

$formFields = [
    'name' => 'Name',
    'desc' => 'Description',
    'user' => 'User'
];

$filterLetter = isset($_GET['filter_letter']) ? strtoupper($_GET['filter_letter']) : '';
$usersList = getUsersList();
$filteredUsers = array_filter($usersList, function ($user) use ($filterLetter) {
    return empty($filterLetter) || strtoupper(substr($user['name'], 0, 1)) == $filterLetter;
});

$page = isset($_GET['user_page']) ? max(1, intval($_GET['user_page'])) : 1;
$perPage = 10;
$startFrom = ($page - 1) * $perPage;
$totalUsers = count($filteredUsers);
$totalPages = ceil($totalUsers / $perPage);
$paginatedUsers = array_slice($filteredUsers, $startFrom, $perPage);

foreach ($formFields as $field => $label) {
    echo '<div class="form-group">';
    echo "<label for=\"$field\">$label :</label>";

    if ($field === 'user') {
        echo "<select class=\"form-control\" id=\"$field\" name=\"$field\" >";
        if (empty($paginatedUsers)) {
            echo "<option value=\"\">No users found</option>";
        } else {
            foreach ($paginatedUsers as $user) {
                echo "<option value=\"{$user['name']}\">{$user['name']}</option>";
            }
        }
        echo "</select>";

        echo '<div class="pagination">';
        foreach (range('A', 'Z') as $letter) {
            echo "<a href=\"?filter_letter=$letter\">$letter</a> ";
        }
        echo '</div>';
    } elseif ($field === 'desc') {
        echo "<input type=\"text\" class=\"form-control\" id=\"$field\" name=\"$field\">";
    } else {
        echo "<input type=\"text\" class=\"form-control\" id=\"$field\" name=\"$field\" required>";
    }

    echo '</div>';
}

echo '<button type="submit" class="btn btn-primary">Add</button>';
?>
