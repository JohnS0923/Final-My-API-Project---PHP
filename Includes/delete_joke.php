<script>
    // Assign the PHP variable value to a JavaScript variable
    var apiKey = '<?php echo $_SESSION['apikey']; ?>';
    var id = '<?php echo $_GET['id']; ?>';

    // Function to update jokes
    function updateJoke() {
        // make a api call all the neccessary information
        axios.get('Model/api.php?key=' + apiKey + '&option=delete&id=' + id)
            .then(function (response) {
                getApiData();
            })
            .catch(function (error) {
                console.log("Error fetching API data:", error);
            });
    }

    // Call the function on page load
    updateJoke();
</script>