<script>
    // Assign the PHP variable value to a JavaScript variable
    var apiKey = '<?php echo $_SESSION['apikey']; ?>';
    var setup = '<?php echo $_GET['setup']; ?>';
    var punchline = '<?php echo $_GET['punchline']; ?>';

    // Function to add joke
    function addJoke() {
        // make a api call all the neccessary information
        axios.get('Model/api.php?key=' + apiKey + '&option=add&setup=' + setup + '&punchline=' + punchline)
            .then(function (response) {
                getApiData();

            })
            .catch(function (error) {
                console.log("Error fetching API data:", error);
            });
    }

    // Call the function on page load
    addJoke();
</script>