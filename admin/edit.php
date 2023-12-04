<?php
echo var_dump($update);


?>

<a href="edit.php?update=<?php if (isset($id)) {
                                                  echo $id;
                                                } ?>" class="btn btn-outline-success"><i class="far fa-edit" title="Update"></i></a>