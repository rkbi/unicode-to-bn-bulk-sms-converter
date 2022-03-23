<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert SMS reports from Unicode to Bangla</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">

                <br>
                <?php if (!empty($_SESSION['success_msg'])) : ?>

                    <div class="alert alert-success" role="alert">
                        <?= $_SESSION['success_msg'] ?>
                    </div>
                    <br>

                <?php endif; ?>

                <form action="u2b.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label" for="input_file_location">Input File Location:</label>
                        <input required class="form-control" type="text" name="input_file_location" id="input_file_location" placeholder="Must be a .csv file.">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unicode_column">Select Unicode Column</label>
                        <select required class="form-control" name="unicode_column" id="unicode_column">
                            <option value="">-- Select --</option>

                            <?php for ($i = 0; $i < 10; $i++) : ?>
                                <option value="<?= $i ?>"><?= chr(65 + $i) ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-info" value="Convert">
                </form>

                <br>
                <?php if (!empty($_SESSION['info_msg'])) : ?>

                    <div class="alert alert-info" role="alert">
                        <?= $_SESSION['info_msg'] ?>
                    </div>

                <?php endif; ?>
                <br>

            </div>
            <div class="col">
                <div class="justify-content-end">
                    <span class=" badge rounded bg-info" data-bs-toggle="modal" data-bs-target="#infoModal">i</span>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">General Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>Input file must be a .csv (Comma Seperated) text file.</li>
                        <li>Output file will be stored in the same location.</li>
                        <li>First row will be ignored.</li>
                        <li>Must be careful to choose right column name for unicode text to convert.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php session_destroy(); ?>