<?php
include('includes/header.php');
$pageTitle = "Characters";

$apiUrl = "https://genshin.jmp.blue/characters/all?lang=en";
$characterList = json_decode(@file_get_contents($apiUrl), true) ?? [];

$searchQuery = strtolower(trim($_GET['search'] ?? ""));
$sortBy = $_GET['sort'] ?? "";

// Search Magic
if ($searchQuery) {
    $characterList = array_filter($characterList, fn($char) => strpos(strtolower($char['name']), $searchQuery) !== false);
}

// This is used to filter based on element and vision
$sortFields = ["Nation" => "nation", "Element" => "vision"];
if (isset($sortFields[$sortBy])) {
    usort($characterList, fn($a, $b) => strcmp($a[$sortFields[$sortBy]] ?? '', $b[$sortFields[$sortBy]] ?? ''));
}
?>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="row">
            <h2 class="mb-0"><strong><?= $pageTitle ?></strong></h2>
            <p class="mb-2">Characters List</p>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav"
            aria-controls="collapseNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapseNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <form method="GET" class="d-flex">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search characters..."
                        value="<?= htmlspecialchars($searchQuery) ?>">

                    <select class="btn btn-outline-secondary" name="sort" onchange="this.form.submit()">
                        <option value="" disabled <?= empty($sortBy) ? 'selected' : '' ?>>Sort by...</option>
                        <option value="Nation" <?= $sortBy == "Nation" ? 'selected' : '' ?>>Nation</option>
                        <option value="Element" <?= $sortBy == "Element" ? 'selected' : '' ?>>Element</option>
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
            <th>Vision</th>
            <th>Name</th>
            <th>Nation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($characterList)): ?>
            <?php $count = 1; ?>
            <?php foreach ($characterList as $character): ?>
                <tr class='table-data-container'>
                    <th scope='row'><?= $count ?></th>
                    <td data-cell="vision"><?= $character['vision'] ?? 'Unknown' ?></td>
                    <td data-cell="name"><?= $character['name'] ?></td>
                    <td data-cell="nation"><?= $character['nation'] ?? 'Unknown' ?></td>
                    <td data-cell="action">
                        <button class="btn btn-primary view-character-btn" data-bs-toggle="modal"
                            data-bs-target="#viewCharacter" <?php
                            $fields = [
                                'name',
                                'title',
                                'vision',
                                'weapon',
                                'gender',
                                'nation',
                                'affiliation',
                                'rarity',
                                'release',
                                'constellation',
                                'birthday',
                                'description'
                            ];
                            foreach ($fields as $field) {
                                echo "data-$field=\"" . ($character[$field] ?? 'Unknown') . "\" ";
                            }
                            ?>
                            data-image="https://genshin.jmp.blue/characters/<?= strtolower(str_replace(' ', '-', $character['name'])) ?>/card">
                            View
                        </button>
                    </td>
                </tr>
                <?php $count++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan='5' class='td-no-data'>No Characters found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


<!-- character information modal -->
<div class="modal fade" id="viewCharacter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Character Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- character image. change accordingly -->
                    <div class="col-md-4 text-center">
                        <img id="characterImage" src="" class="img-fluid rounded" width="250px">
                    </div>

                    <!-- character details -->
                    <div class="col-md-8">
                        <h3 id="characterName"></h3>
                        <p><strong>Title:</strong> <span id="characterTitle"></span></p>
                        <p><strong>Vision:</strong> <span id="characterVision"></span></p>
                        <p><strong>Weapon:</strong> <span id="characterWeapon"></span></p>
                        <p><strong>Gender:</strong> <span id="characterGender"></span></p>
                        <p><strong>Nation:</strong> <span id="characterNation"></span></p>
                        <p><strong>Affiliation:</strong> <span id="characterAffiliation"></span></p>
                        <p><strong>Rarity:</strong> <span id="characterRarity"></span> ⭐</p>
                        <p><strong>Release Date:</strong> <span id="characterRelease"></span></p>
                        <p><strong>Constellation:</strong> <span id="characterConstellation"></span></p>
                        <p><strong>Birthday:</strong> <span id="characterBirthday"></span></p>
                        <p><strong>Description:</strong> <span id="characterDescription"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.view-character-btn').forEach(button => {
        button.addEventListener('click', function () {
            // i tried using fields because i hate hard coding them. this is easy to code
            const fields = ['name', 'title', 'vision', 'weapon', 'gender', 'nation',
                'affiliation', 'rarity', 'release', 'constellation', 'birthday', 'description'];

            fields.forEach(field => {
                document.getElementById(`character${field.charAt(0).toUpperCase() + field.slice(1)}`).textContent = this.getAttribute(`data-${field}`);
            });
            document.getElementById('characterImage').src = this.getAttribute('data-image');
        });
    });
</script>


<?php include('includes/footer.php'); ?>