<?php
include('includes/header.php');
$pageTitle = "Enemies"; // Page Title... DUH!!!
$modalTitle = "Enemy"; // Title when you open the modal

$category = "enemies"; // MUST BE LOWERCASE! Define the field for the search bar and data-image="https://genshin.jmp.blue/ $category / If the image doesn't show, try changing the $data from 'name' to 'id'
$apiUrl = "https://genshin.jmp.blue/enemies/all?lang=en";
$dataList = json_decode(@file_get_contents($apiUrl), true) ?? [];

// Define all the needed attributes here from the API
$fields = ['name', 'region', 'type', 'family', 'description'];

// Query for the search and sort
$searchQuery = strtolower(trim($_GET['search'] ?? ""));
$sortBy = $_GET['sort'] ?? "";

$options = [ // You can define what options are available for sorting (dropdown)
    "Type" => ["Common Enemies", "Elite Enemies", "Unique Enemies"]
];

// Search Magic
if ($searchQuery) {
    $dataList = array_filter($dataList, fn($char) => stripos($char['name'], $searchQuery) !== false);
}

if (in_array($sortBy, array_merge($options["Type"]))) {
    $dataList = array_filter($dataList, fn($char) => ($char['type'] ?? '') === $sortBy || ($char['vision'] ?? '') === $sortBy);
}
?>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="row">
            <h2 class="mb-0"><strong><?= $pageTitle ?></strong></h2>
            <p class="mb-2">Enemy List</p>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav"
            aria-controls="collapseNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapseNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <form method="GET" class="d-flex">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search <?= $category ?>..."
                        value="<?= htmlspecialchars($searchQuery) ?>">

                    <select class="btn btn-outline-secondary" name="sort" onchange="this.form.submit()">
                        <option value="" disabled <?= empty($sortBy) ? 'selected' : '' ?>>Sort by...</option>
                        <?php foreach ($options as $categoryName => $values): ?>
                            <optgroup label="<?= $categoryName ?>">
                                <?php foreach ($values as $value): ?>
                                    <option value="<?= $value ?>" <?= $sortBy === $value ? 'selected' : '' ?>><?= $value ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>

                    <!-- Optional Search Button -->
                    <!-- <button class="btn btn-primary" type="submit">Search</button> -->
                </div>
            </form>
        </div>
    </div>
</nav>

<table class="table">
    <thead class="tbl_thead">
        <tr>
            <th class="tbl_id">#</th>
            <th>Name</th>
            <th>Region</th>
            <th>Type</th>
            <th>Family</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dataList)): ?>
            <?php foreach ($dataList as $index => $data): ?>
                <tr>
                    <th><?= $index + 1 ?></th>
                    <td><?= $data['name'] ?? 'Unknown' ?></td>
                    <td><?= $data['region'] ?></td>
                    <td><?= $data['type'] ?? 'Unknown' ?></td>
                    <td><?= $data['family'] ?? 'Unknown' ?></td>
                    <td>
                        <button class="btn btn-primary view-modal-btn" data-bs-toggle="modal" data-bs-target="#viewModal" <?php
                        foreach ($fields as $field):
                            $value = htmlspecialchars($data[$field] ?? 'Unknown', ENT_QUOTES);
                            echo " data-{$field}=\"{$value}\"";
                        endforeach;
                        ?>
                            data-image="https://genshin.jmp.blue/<?= $category ?>/<?= strtolower(str_replace(' ', '-', $data['name'])) ?>/portrait">
                            View
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No Enemies found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Information Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $modalTitle ?> Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-4 text-center">
                    <img id="characterImage" class="img-fluid rounded" alt="No Image found for this entity." width="250">
                </div>
                <div class="col-md-8">
                    <?php foreach ($fields as $field): ?>
                        <p><strong><?= ucfirst($field) ?>:</strong> <span id="character<?= ucfirst($field) ?>"></span></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // i try to dynamically allocate the data but i can't put a STAR symbol next to the rarity variable loool
    document.querySelectorAll('.view-modal-btn').forEach(button => {
        const fields = <?= json_encode($fields) ?>;
        button.addEventListener('click', function () {
            fields.forEach(field => {
                document.getElementById(`character${field.charAt(0).toUpperCase() + field.slice(1)}`).textContent = this.getAttribute(`data-${field}`);
            });
            document.getElementById('characterImage').src = this.getAttribute('data-image');
        });
    });
</script>
