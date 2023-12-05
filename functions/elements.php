<?php
                                $formFields = [
                                    'name' => 'Name',
                                    'desc' => 'Description',
                                    'storage' => 'Storage Number'
                                ];

                                foreach ($formFields as $field => $label) {
                                    echo '<div class="form-group">';
                                    echo "<label for=\"$field\">$label :</label>";
                                    if ($field === 'storage') {
                                        echo "<input type=\"number\" class=\"form-control\" id=\"$field\" name=\"$field\" min=\"0\" value=\"0\" required>";
                                    } else {
                                        echo "<input type=\"text\" class=\"form-control\" id=\"$field\" name=\"$field\" required>";
                                    }
                                        echo '</div>';
                                }
                            ?>