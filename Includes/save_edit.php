<script>
    // Assign the PHP variable value to a JavaScript variable
    var apiKey = '<?php echo $_SESSION['apikey']; ?>';
    var id = '<?php echo $_GET['id']; ?>';
    var setup = '<?php echo $_GET['setup']; ?>';
    var punchline = '<?php echo $_GET['punchline']; ?>';

    // Function to update jokes
    function updateJoke() {
        // make a api call all the neccessary information
        axios.get('Model/api.php?key=' + apiKey + '&option=edit&id=' + id + '&setup=' + setup + '&punchline=' + punchline)
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