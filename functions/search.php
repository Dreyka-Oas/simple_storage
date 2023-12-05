<?php
                                            $searchColumns = [
                                                'name' => 'Name',
                                                'description' => 'Description',
                                                'storage' => 'Storage Number'
                                            ];
                                            
                                            foreach ($searchColumns as $column => $columnLabel) {
                                                echo "<option value=\"$column\">$columnLabel</option>";
                                            }
                                            ?>