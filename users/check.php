if (isset($_POST['submit'])) {
    // Iterate over $_POST array
    foreach ($_POST as $key => $value) {
        // Print input name and its corresponding value
        echo "Input name: $key, Value: $value <br>";
    }
}