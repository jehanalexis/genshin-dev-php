<?php
include('includes/header.php');
$pageTitle = "Materials";

$apiUrl = "https://genshin.jmp.blue/materials/talent-book";
$response = file_get_contents($apiUrl);
$talentBooks = json_decode($response, true);

$searchQuery = strtolower(trim($_GET['search'] ?? ""));
$sortBy = $_GET['sort'] ?? "";

// search
function searchTalentBooks($books, $query)
{
    if (!$query)
        return $books;

    $filteredBooks = [];
    foreach ($books as $bookName => $book) {
        $nameMatch = strpos(strtolower($bookName), $query) !== false;
        $sourceMatch = strpos(strtolower($book['source'] ?? ""), $query) !== false;

        if ($nameMatch || $sourceMatch) {
            $filteredBooks[$bookName] = $book;
        }
    }

    return $filteredBooks;
}


// idk for some reason i cant get this to work. maybe API mismatch?
// since the 'availability' array does not match the API's availability schedule, the filtering logic doesn't work
// i tried using array_intersect
function sortTalentBooks($books, $sortBy)
{
    $availabilityDays = [
        "Mon/Thu/Sun" => ["Monday", "Thursday", "Sunday"],
        "Tue/Fri/Sun" => ["Tuesday", "Friday", "Sunday"],
        "Wed/Sat/Sun" => ["Wednesday", "Saturday", "Sunday"]
    ];

    if (!isset($availabilityDays[$sortBy])) {
        return $books;
    }

    return array_filter($books, function ($book) use ($availabilityDays, $sortBy) {
        if (!isset($book['availability']) || !is_array($book['availability'])) {
            return false;
        }

        return count(array_intersect($book['availability'], $availabilityDays[$sortBy])) > 0;
    });
}

// sort. (will change later)
$filteredTalentBooks = searchTalentBooks($talentBooks, $searchQuery);
$filteredTalentBooks = sortTalentBooks($filteredTalentBooks, $sortBy);

// (i will change these codes later for more short and efficient ones...)
?>


<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="row">
            <h2 class="mb-0"><strong><?= $pageTitle ?></strong></h2>
            <p class="mb-2">List of Materials</p>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav"
            aria-controls="collapseNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapseNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <form method="GET" class="d-flex">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search talent books..."
                        value="<?= htmlspecialchars($searchQuery) ?>">

                    <select class="btn btn-outline-secondary" name="sort" onchange="this.form.submit()">
                        <option value="" disabled <?= empty($sortBy) ? 'selected' : '' ?>>Sort by...</option>
                        <option value="Mon/Thu/Sun" <?= $sortBy == "Mon/Thu/Sun" ? 'selected' : '' ?>>Mon/Thu/Sun</option>
                        <option value="Tue/Fri/Sun" <?= $sortBy == "Tue/Fri/Sun" ? 'selected' : '' ?>>Tue/Fri/Sun</option>
                        <option value="Wed/Sat/Sun" <?= $sortBy == "Wed/Sat/Sun" ? 'selected' : '' ?>>Wed/Sat/Sun</option>
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
            <th>Characters</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($filteredTalentBooks)): ?>
            <?php $count = 1; ?>
            <?php foreach ($filteredTalentBooks as $bookName => $book): ?>
                <tr class='table-data-container'>
                    <th scope='row'><?= $count ?></th>
                    <td data-cell="name"><?= ucfirst($bookName) ?></td>
                    <td data-cell="source"><?= ucfirst(str_replace('-', ' ', $book['source'] ?? 'Unknown')) ?></td>
                    <td data-cell="availability"><?= implode(", ", $book['availability'] ?? ['Unknown']) ?></td>
                    <td data-cell="characters">
                        <?= implode(", ", array_map('ucfirst', $book['characters'] ?? ['None'])) ?>
                    </td>
                    <td data-cell="action">
                        <button class="btn btn-primary view-material-btn" data-bs-toggle="modal" data-bs-target="#viewMaterial"
                            data-name="<?= htmlspecialchars(ucfirst($bookName)) ?>"
                            data-source="<?= htmlspecialchars($book['source'] ?? 'Unknown') ?>"
                            data-availability="<?= htmlspecialchars(implode(", ", $book['availability'] ?? ['Unknown'])) ?>"
                            data-characters="<?= htmlspecialchars(implode(", ", array_map('ucfirst', $book['characters'] ?? ['None']))) ?>">
                            View
                        </button>
                    </td>
                </tr>
                <?php $count++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan='6' class='td-no-data'>No Talent Books found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include('includes/footer.php'); ?>