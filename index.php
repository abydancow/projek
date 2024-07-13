<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>METODE BISEKSI</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>METODE BISEKSI</h1>
        <div class="content">
            <div class="form-box">
                <form id="bisectionForm">
                    <label for="function">Fungsi (f(x)):</label>
                    <input type="text" id="function" name="function" placeholder="e.g., x^3 - x - 2" required>
                    <br><br>
                    <label for="lower_bound">Batas Bawah (a):</label>
                    <input type="number" step="any" id="lower_bound" name="lower_bound" required>
                    <br><br>
                    <label for="upper_bound">Batas Aatas (b):</label>
                    <input type="number" step="any" id="upper_bound" name="upper_bound" required>
                    <br><br>
                    <label for="tolerance">Tolerance:</label>
                    <input type="number" step="any" id="tolerance" name="tolerance" value="0.0001" required>
                    <br><br>
                    <label for="max_iterations">Banyak Iterasi:</label>
                    <input type="number" id="max_iterations" name="max_iterations" value="100" required>
                    <br><br>
                    <input type="submit" value="Find Root">
                    <input type="reset" value="Reset">
                </form>
            </div>
            <div class="result-box">
                <div id="result"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#bisectionForm").on("submit", function(event) {
                event.preventDefault(); // Mencegah form dari pengiriman standar

                $.ajax({
                    url: 'process.php',
                    type: 'post',
                    data: $(this).serialize(),
                    success: function(response) {
                        $("#result").html(response); // Menampilkan hasil di div result
                    }
                });
            });

            // Mengosongkan hasil ketika tombol reset ditekan
            $("input[type='reset']").on("click", function() {
                $("#result").empty(); // Menghapus isi div hasil
            });
        });
    </script>
</body>

</html>