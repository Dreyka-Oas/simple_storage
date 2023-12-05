<?php
                    if (!empty($data)) {
                        echo '<table class="table table-striped">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col"><a>Num</a></th>';
                        echo '<th scope="col"><a href="?sort=name">Name</a></th>';
                        echo '<th scope="col"><a href="?sort=description">Description</a></th>';
                        echo '<th scope="col"><a href="?sort=storage">Storage Number</a></th>';
                        echo '<th scope="col">Actions</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        $counter = 1 + $startFrom;
                        foreach ($data as $row) {
                            echo '<tr>';
                            echo '<td>' . $counter . '. </td>';
                            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['storage']) . '</td>';
                            echo '<td>';
                            echo '<a href="controller/edit_element.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm btn-actions">Edit</a>';
                            echo '<a href="controller/delete_element.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm btn-actions">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                            $counter++;
                        }
                        echo '</tbody>';
                        echo '</table>';
                 
                        echo '<div class="text-center"><ul class="pagination">';

                        if ($totalPages > 10) {
                        echo '<li class="page-item"><a class="page-link" href="?page=1&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">1</a></li>';
                        }
                        if ($page > 10) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">&laquo;</a></li>';
                        }
                        for ($i = max(1, $page - 9); $i <= min($totalPages, $page + 9); $i++) {
                            echo '<li class="page-item';
                            if ($page == $i) {
                                echo ' active';
                            }
                            echo '"><a class="page-link" href="?page=' . $i . '&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">' . $i . '</a></li>';
                        }

                        if ($page < $totalPages - 10) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">&raquo;</a></li>';
                        }
                        if ($totalPages > 10) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">' . $totalPages . '</a></li>';
                        }
                        echo '</ul></div>';

                    } else {
                        echo '<p class="text-muted">No elements found in the storage_p table.</p>';
                    }
                    ?>