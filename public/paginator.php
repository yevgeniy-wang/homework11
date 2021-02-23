<?php
if (isset($posts)) {
    $page = 'posts';
    $table = &$posts;
} elseif (isset($categories)) {
    $page = 'categories';
    $table = &$categories;
} elseif (isset($tags)) {
    $page = 'tags';
    $table = &$tags;
}


echo '<div class="mb-3">
        <nav aria-label="...">
            <ul class="pagination">';

if ($table->currentPage() != 1) {
    echo '<li class="page-item">
                        <a class="page-link" href="/' . $page . $table->previousPageUrl() . '" tabindex="-1"
                           aria-disabled="true">Previous</a>
                    </li>';
    if ($table->currentPage() - 3 >= 1) {
        echo '<li class="page-item">
                            <a class="page-link" href="/' . $page . '">1</a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link">...</a>
                        </li>';
    }
    echo '<li class="page-item">
                        <a class="page-link"
                           href="/' . $page . $table->previousPageUrl() . '">' . ($table->currentPage() - 1) . '</a>
                    </li>';
}
echo '<li class="page-item active" aria-current="page">
                    <a class="page-link">' . $table->currentPage() . '</a>
                </li>';

if ($table->currentPage() != $table->lastPage()) {
    echo '<li class="page-item">
                        <a class="page-link"
                           href="/' . $page . $table->nextPageUrl() . '">' . ($table->currentPage() + 1) . '</a>
                    </li>';

    if ($table->currentPage() + 3 <= $table->lastPage()) {
        echo '<li class="page-item disabled">
                            <a class="page-link">...</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link"
                               href="/' . $page . '?page=' . $table->lastPage() . '">' . $table->lastPage() . '</a>
                        </li>';
    }

    echo '<li class="page-item">
                        <a class="page-link" href="/' . $page . $table->nextPageUrl() . '">Next</a>
                    </li>';
}

echo '</ul>
        </nav>
    </div>';
