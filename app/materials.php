<?php
include('includes/header.php');
$pageTitle = "Talent Books";
$modalTitle = "Talent Book"; // Title when you open the modal

$category = "talent-book"; // MUST BE LOWERCASE! Define the field for the search bar and data-image="https://genshin.jmp.blue/ $category / If the image doesn't show, try changing the $data from 'name' to 'id'
$apiUrl = "https://genshin.jmp.blue/materials/talent-book/";
$dataList = json_decode(@file_get_contents($apiUrl), true) ?? [];

// Define all the needed attributes here from the API
$fields = ['name', 'source', 'availability', 'characters', 'description'];

// Query for the search and sort
$searchQuery = strtolower(trim($_GET['search'] ?? ""));
$sortBy = $_GET['sort'] ?? "";

$options = [ // You can define what options are available for sorting (dropdown)
    "Availability" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
];

// Search Magic
if ($searchQuery) {
    $dataList = array_filter($dataList, fn($char) => stripos($char['name'], $searchQuery) !== false);
}

if (in_array($sortBy, array_merge($options["Availability"]))) {
    $dataList = array_filter($dataList, fn($char) => ($char['availability'] ?? '') === $sortBy);
}
?>

<!-- i had to use this because i can't align the data attributes in the API properly without checking the array Ids. Skill issues indeed... -->
<!-- <pre><?php print_r($dataList); ?></pre> -->

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
            <th>Source</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dataList)): ?>
            <?php $count = 0; ?>
            <?php foreach ($dataList as $category => $data): ?>
                <tr>
                    <th><?= ++$count ?></th>
                    <td><?= htmlspecialchars(ucfirst($category), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars(ucwords(str_replace('-', ' ', $data['source'] ?? 'Unknown')), ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <?= isset($data['availability']) ? htmlspecialchars(implode(', ', $data['availability']), ENT_QUOTES, 'UTF-8') : 'Unknown' ?>
                    </td>
                    <td>
                        <button class="btn btn-primary view-modal-btn" data-bs-toggle="modal" data-bs-target="#viewModal" <?php
                        foreach ($fields as $field):
                            if (isset($data[$field])) {
                                $value = $data[$field];
                                if (is_array($value)) {
                                    $value = implode(', ', $value);
                                }
                                echo " data-{$field}=\"" . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "\"";
                            }
                        endforeach;
                        ?>
                            data-image="https://genshin.jmp.blue/materials/<?= strtolower(str_replace(' ', '-', $category)) ?>/portrait">
                            View
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="td-no-data">No Talent Books found.</td>
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
                    <img id="entityImage" class="img-fluid rounded" alt="No Image found for this entity." width="250">
                </div>
                <div class="col-md-8">
                    <?php foreach ($fields as $field): ?>
                        <p><strong><?= ucfirst($field) ?>:</strong> <span id="fieldText<?= ucfirst($field) ?>"></span></p>
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
                document.getElementById(`fieldText${field.charAt(0).toUpperCase() + field.slice(1)}`).textContent = this.getAttribute(`data-${field}`);
            });
            document.getElementById('entityImage').src = this.getAttribute('data-image');
        });
    });
</script>

<?php include('includes/footer.php'); ?>