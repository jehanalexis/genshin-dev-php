<?php
include('includes/header.php');
$pageTitle = "Template"; // Page Title... DUH!!!
$modalTitle = ""; // Title when you open the modal

$category = ""; // MUST BE LOWERCASE! Define the field for the search bar and data-image="https://genshin.jmp.blue/ $category / If the image doesn't show, try changing the $data from 'name' to 'id'
$apiUrl = "";
// $dataList = json_decode(@file_get_contents($apiUrl), true) ?? []; // Enable this if $apiUrl is present

// Define all the needed attributes here from the API
$fields = [];

// Query for the search and sort
$searchQuery = strtolower(trim($_GET['search'] ?? ""));
$sortBy = $_GET['sort'] ?? "";

$options = [ // You can define what options are available for sorting (dropdown)
    // Example fields:
    // "Nation" => ["Mondstadt", "Liyue", "Inazuma", "Sumeru", "Fontaine", "Natlan"],
    // "Element" => ["Anemo", "Pyro", "Hydro", "Geo", "Electro", "Cryo", "Dendro"]
];

// Search Magic
// if ($searchQuery) {
//     $dataList = array_filter($dataList, fn($char) => stripos($char['name'], $searchQuery) !== false);
// }

// if (in_array($sortBy, array_merge($options[""]))) { // can be any
//     $dataList = array_filter($dataList, fn($char) => ($char[''] ?? '') === $sortBy); // can be any. just put || operator;
// }
?>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="row">
            <h2 class="mb-0"><strong><?= $pageTitle ?></strong></h2>
            <p class="mb-2">You can use this template.</p>
        </div>
    </div>
</nav>

<?php include('includes/footer.php'); ?>